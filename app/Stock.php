<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model {

    //
    protected $table = "stock";
    protected $fillable = [
        'name', 'address',
    ];

    public function created_at() {
        return date('d/m/Y', strtotime($this->created_at));
    }

    public function createdBy() {
        return $this->belongsTo('App\User', 'created_by');
    }

}
