<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model {

    //
    protected $table = "supplier";
    protected $fillable = [
        'name', 'tax_code', 'email', 'address'
    ];

    public function created_at() {
        return date('d/m/Y', strtotime($this->created_at));
    }

    public function createdBy() {
        return $this->belongsTo('App\User', 'created_by');
    }

}
