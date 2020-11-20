<?php

/**
 * Created by PhpStorm.
 * User: Hien
 * Date: 12/09/2019
 * Time: 11:03 AM
 */

namespace App\Repositories;

use Repositories\Support\AbstractRepository;
use Illuminate\Support\Facades\DB;

class ProductRepository extends AbstractRepository {

    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\ImportBill';
    }

    public function validateCreate() {
        return $rules = [
            'name'=> 'required|unique:import_bill',
            
            'stock_id' => 'required',
            'supplier_id' => 'required',
            'vat' => 'required',
            'vat_type' => 'required',
            'vat_number' => 'required',
            'vat_date' => 'required',
            
//
        ];
    }

    public function validateUpdate($id) {
        return $rules = [
            
            'name' => 'required|unique:import_bill,name,' . $id . ',id',
            'stock_id' => 'required',
            'supplier_id' => 'required',
            'vat' => 'required',
            'vat_type' => 'required',
            'vat_number' => 'required',
            'vat_date' => 'required',
        ];
    }

    // public function readFE($request) {
    //     $model = $this->model;
    //     if ($request->get('category_id')) {
    //         $product_ids = \Db::table('product_category')->where('category_id', $request->get('category_id'))->pluck('product_id');
    //         $model = $model->whereIn('id', $product_ids);
    //     }
    //     if ($request->get('attribute_id')) {
    //         $attribute_ids = explode(',', $request->get('attribute_id'));
    //         $product_ids = \Db::table('product_attribute')->whereIn('attribute_id', $attribute_ids)->pluck('product_id');
    //         $model = $model->whereIn('id', $product_ids);
    //     }
    //     if ($request->get('keyword')) {
    //         $category = \App\Category::where('title','like',$request->get('keyword'))->first();
    //         if($category){
    //             $product_ids1 = \Db::table('product_category')->where('category_id', $category->id)->pluck('product_id');
    //             $model = $model->whereIn('id', $product_ids1);
    //         }else{
    //             $model = $model->where(function ($query) use ($request) {
    //                 return $query->where('title', 'like', '%' . $request->get('keyword') . '%')
    //                                 ->orWhere('keywords', 'like', '% ' . $request->get('keyword') . ' %');
    //             });
    //         }
    //     }
    //     if ($request->get('count_product')) {
    //         $limit = $request->get('count_product');
    //     }
    //     else{
    //         $limit = 80;
    //     }
    //     return $model->where('status', 1)->orderBy(DB::raw('RAND()'))->paginate($limit);
    // }
    // public function readSale($request) {
    //     $model = $this->model;
    //     if ($request->get('category_id')) {
    //         $product_ids = \Db::table('product_category')->where('category_id', $request->get('category_id'))->pluck('product_id');
    //         $model = $model->whereIn('id', $product_ids);
    //     }
    //     if ($request->get('attribute_id')) {
    //         $attribute_ids = explode(',', $request->get('attribute_id'));
    //         $product_ids = \Db::table('product_attribute')->whereIn('attribute_id', $attribute_ids)->pluck('product_id');
    //         $model = $model->whereIn('id', $product_ids);
    //     }
    //     if ($request->get('keyword')) {
    //         $model = $model->where(function ($query) use ($request) {
    //             return $query->where('title', 'like', '%' . $request->get('keyword') . '%')
    //                             ->orWhere('content', 'like', '%' . $request->get('keyword') . '%');
    //         });
    //     }
    //     if ($request->get('count_product')) {
    //         $limit = $request->get('count_product');
    //     }
    //     else{
    //         $limit = 80;
    //     }
    //     return $model->where('sale_price','>',0)->where('status', 1)->orderBy('created_at', 'desc')->paginate($limit);
    // }
    // public function getCategorySale($product_id){
    //     $model = $this->model;
    //     $category_ids = \Db::table('product_category')->where('product_id', $product_id)->where('category_id','<>',80)->pluck('category_id');
    //     $product_ids = \Db::table('product_category')->whereIn('category_id', $category_ids)->pluck('product_id');
    //     $model = $model->whereIn('id', $product_ids);
    //     return $model->where('sale_price','>',0)->where('status', 1)->orderBy('created_at', 'desc')->get();
    // }
    // public function allProduct() {
    //     return $this->model->where('status', 1)->get();
    // }

    // public function findByAlias($alias) {
    //     return $this->model->where('alias', '=', $alias)->first();
    // }

    // public function readRelatedProduct($limit = 15, $category) {
    //     $product_ids = \DB::table('product_category')->where('category_id', $category->id)->pluck('product_id');
    //     return $this->model->where('status', 1)->whereIn('id', $product_ids)->orderBy('created_at', 'desc')->take($limit)->get();
    // }

    // public function readRelatedProducts($keywords, $limit = 15) {
    //     $query = $this->model->where('status', 1);
    //     $keyword_arr = explode(',', $keywords);
    //     $query = $query->where(function($que) use($keyword_arr) {
    //         foreach ($keyword_arr as $val) {
    //             if($val != 'alagreen'){
    //                 $que = $que->orWhere('title', 'LIKE', '%' . trim($val) . '%')->orWhere('keywords', 'LIKE', '%' . trim($val) . '%');
    //             }
    //         }
    //         return $que;
    //     });
    //     $data = $query->select('price', 'alias', 'images', 'title', 'created_by', 'view_count')->take($limit)->get();
    //     return $data;
    // }

    // public function readNewProduct($limit = 10) {
    //     return $this->model->where('status', 1)->where('is_new', 1)->orderBy('updated_at', 'desc')->take($limit)->get();
    // }
    // public function readViewProduct($limit = 10) {
    //     return $this->model->where('status', 1)->orderBy('view_count', 'desc')->take($limit)->get();
    // }
    // public function readRecentProduct($page = 0, $limit = 3) {
    //     $data = $this->model->where('status', 1)->orderBy(DB::raw('RAND()'))->skip($page * $limit)->take($limit)->get();
    //     return $data;
    // }
    // public function getViewedProduct() {
    //     return $this->model->whereIn('id', session('id'))->get();
    // }
    // public function getProductByKeyword($keyword, $limit = 50) {
    //     return $this->model->where('status', 1)->where('title', 'like', '%' . $keyword . '%')->take($limit)->pluck('title');
    // }
    // public function getProductsByTag($tag_title, $limit = 20) {
    //     return $this->model->select('title', 'alias', 'images')->where('title', 'like', '%' . $tag_title . '%')->orWhere('keywords', 'like', '%' . $tag_title . '%')->take($limit)->get();
    // }
    // public function getConfig($id) {
    //     return $this->model->select('title', 'description','keywords', 'meta_title', 'meta_keywords', 'meta_description')->where('id', $id)->first();
    // }

}
