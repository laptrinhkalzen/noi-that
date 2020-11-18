<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {

    //
    protected $table = 'item';
    protected $fillable = [
        'title', 'alias', 'category_id', 'ordering', 'status'
    ];

    public function created_at() {
        return date("d/m/Y", strtotime($this->created_at));
    }

}
