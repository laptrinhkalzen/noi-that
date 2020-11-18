<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    const TYPE_VIDEO = 1;
    const TYPE_NEWS = 2;
    const TYPE_GALLERY = 3;
    const TYPE_PRODUCT = 4;
    const TYPE_CONSTRUCTION = 5;
    const PRODUCT_SHOP_ID = 80;
    const GALLERY_ALBUM = 40;

    protected $table = 'category';
    protected $fillable = [
        'title', 'parent_id', 'alias', 'image', 'description', 'type', 'is_home', 'status', 'ordering'
    ];

    public function created_at() {
        return date("d/m/Y", strtotime($this->created_at));
    }

    public function updated_at() {
        return date("d/m/Y", strtotime($this->updated_at));
    }

    /* Get all children */

    public function children() {
        return $this->hasMany('\App\Category', 'parent_id');
    }

    /**/
    /* Get all parent */

    public function parents() {
        return $this->belongsTo('\App\Category', 'parent_id');
    }

    public function parentCategories() {
        return $this->belongsTo('\App\Category', 'parent_id')->with('parents');
    }

    /**/

    public function urlNews() {
        return route('news_category.index', ['alias' => $this->alias]);
    }

    public function url() {
        return '#';
    }

    public function products() {
        return $this->belongsToMany('\App\Product', 'product_category', 'category_id', 'product_id');
    }

    public function galleries() {
        return $this->belongsToMany('\App\Gallery', 'gallery_category', 'category_id', 'gallery_id');
    }

    public function news() {
        return $this->belongsToMany('\App\News', 'news_category', 'category_id', 'news_id');
    }

    public function videos() {
        return $this->belongsToMany('\App\Video', 'video_category', 'category_id', 'video_id')->withPivot('category_id');
    }

    public function items() {
        return $this->hasMany('\App\Item');
    }

}
