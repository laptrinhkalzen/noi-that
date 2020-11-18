<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model {

    //
    protected $table = "gallery";
    protected $fillable = [
        'project_id', 'created_by', 'content', 'keywords', 'meta_title', 'meta_description', 'meta_keywords', 'view_count', 'post_schedule', 'title', 'alias', 'images', 'description', 'status', 'ordering'
    ];
    public function categories() {
        return $this->belongsToMany('\App\Category', 'gallery_category', 'gallery_id', 'category_id');
    }

    public function getImage() {
        $image_arr = explode(',', $this->images);
        return $image_arr[0];
    }

    public function attributes() {
        return $this->belongsToMany('\App\Attribute', 'gallery_attribute', 'gallery_id', 'attribute_id')->withPivot('value');
    }

    public function getPostSchedule() {
        return date('d/m/Y', strtotime($this->post_schedule != '0000-00-00 00:00:00' ?: $this->created_at));
    }

    public function user() {
        return $this->belongsTo('App\User', 'created_by');
    }
    public function construction() {
        return $this->belongsTo('App\Construction', 'created_by');
    }
     public function project() {
        $data = $this->belongsTo('\App\Project', 'project_id', 'id');
        return $data;
    }
    public function url() {
        return route('gallery.detail', ['alias' => $this->alias]);
    }

}
