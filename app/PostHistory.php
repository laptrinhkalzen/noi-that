<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostHistory extends Model {

    //
    protected $table = "post_history";
    protected $fillable = [
        'item_id', 'module', 'created_at', 'updated_at'
    ];
    public $timestamps = false;
}
