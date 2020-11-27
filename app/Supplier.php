<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model {

    //
    protected $table = "supplier";
    protected $fillable = [
        'supplier_name', 'phone', 'email', 'address','describe','total_payment','payment_due'
    ];

    public function created_at() {
        return date('d/m/Y', strtotime($this->created_at));
    }

    public function createdBy() {
        return $this->belongsTo('App\User', 'created_by');
    }

}
