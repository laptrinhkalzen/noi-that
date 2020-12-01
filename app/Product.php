<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    protected $table = 'product';
    protected $fillable = [
        'code','created_by', 'is_hot', 'is_new', 'content', 'price', 'sale_price','wholesale_price', 'images', 'title', 'description', 'keywords', 'meta_title', 'meta_description', 'meta_keywords', 'view_count', 'status', 'alias', 'ordering', 'post_schedule','sell_price'
    ];

    public function attributes() {
        return $this->belongsToMany('\App\Attribute', 'product_attribute', 'product_id', 'attribute_id')->withPivot('value');
    }

    public function categories() {
        return $this->belongsToMany('\App\Category', 'product_category', 'product_id', 'category_id');
    }

    public function product_attributes() {
        return $this->hasMany('App\ProductAttribute', 'product_id');
    }

    public function getPostSchedule() {
        return date('d/m/Y', strtotime($this->post_schedule != '0000-00-00 00:00:00' ?: $this->created_at));
    }

    public function getImage() {
        $image_arr = explode(',', $this->images);
        return $image_arr[0];
    }

    public function getPrice() {
        return $this->price > 0 ? number_format($this->price) . ' đ' : 'Liên hệ';
    }

    public function getSalePrice() {
        return number_format($this->sale_price) . ' đ';
    }

    public function createdBy() {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function url() {
        return route('product.detail', ['alias' => $this->alias]);
    }
}
