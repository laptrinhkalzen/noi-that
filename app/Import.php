<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
	
    protected $table = 'import';
    protected $fillable = ['import_id','payment_type','stock_id','supplier_id', 'bill_type','note','total','discount','discount_type','total_payment','paid','payment_remand','payment_day','create_by','order_date','created_at','updated_at'];
    protected $primaryKey ='import_id';
    public function created_at() {
        return date("d/m/Y", strtotime($this->created_at));
    }

    public function updated_at() {
        return date("d/m/Y", strtotime($this->updated_at));
    }
  
}
