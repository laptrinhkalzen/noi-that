<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Repositories\CouponRepository;
use App\Repositories\ProductRepository;
use Repositories\CategoryRepository;
use Repositories\AttributeRepository;
use Repositories\PostHistoryRepository;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use TIMESTAMP;
use DB;


class CouponController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(CouponRepository $couponRepo) {
        $this->couponRepo = $couponRepo;
      
    }

    public function index() {
        $coupons = $this->couponRepo->all();
        return view('backend/coupon/index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        // $members=DB::table('member')->orderBy('created_at', 'desc')->get();
        return view('backend/coupon/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $input = $request->all();
        $validator = \Validator::make($input, $this->couponRepo->validateCreate());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $input['coupon_status'] = isset($input['coupon_status']) ? 1 : 0;
        
        $coupon = $this->couponRepo->create($input);
        
        if ($coupon) {
            return redirect()->route('admin.coupon.index')->with('success', 'Tạo mới thành công');
        } else {
            return redirect()->route('admin.coupon.index')->with('error', 'Tạo mới thất bại');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
         $record = $this->couponRepo->find($id);
         $coupon_end=DB::table('coupon')->where('id',$id)->get('coupon_end');
        return view('backend/coupon/edit')->with('record',$record)->with('coupon_end',$coupon_end);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $input = $request->all();
        $validator = \Validator::make($input, $this->couponRepo->validateUpdate($id));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $input['coupon_status'] = isset($input['coupon_status']) ? 1 : 0;
         $res = $this->couponRepo->update($input, $id);
        if ($res) {
            return redirect()->route('admin.coupon.index')->with('success', 'Cập nhật thành công');
        } else {
            return redirect()->route('admin.coupon.index')->with('error', 'Cập nhật thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $coupon = $this->couponRepo->find($id);
        $this->couponRepo->delete($id);
        return redirect()->back()->with('success', 'Xóa thành công');
    }

    public function getProductAttributes($input) {
        $attributes = array();
        foreach ($input['attribute'] as $key => $val) {
            $attributes[$key] = ['value' => $val];
        }
        foreach ($input['attribute_select'] as $key => $val) {
            if ($val != null) {
                $attributes[$val] = ['value' => null];
            }
        }
        return $attributes;
    }

    // public function addPostHistory($product) {

    //     $post_history['item_id'] = $product->id;
    //     $post_history['created_at'] = $product->created_at;
    //     $post_history['updated_at'] = $product->post_schedule ?: $product->updated_at;
    //     $post_history['module'] = 'product';
    //     $this->postHistoryRepo->create($post_history);
    // }

}
