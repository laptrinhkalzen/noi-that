<?php

namespace App;

// use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Foundation\Auth\User as Authenticatable
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
	public $timestamps = true;
    protected $table = 'coupon';
    protected $fillable = ['member_id','coupon_name','coupon_number','coupon_status', 'coupon_type','created_at','updated_at','coupon_code','coupon_end','coupon_value','coupon_condition'];
    protected $primaryKey ='id';
    public function created_at() {
        return date("d/m/Y", strtotime($this->created_at));
    }

    public function updated_at() {
        return date("d/m/Y", strtotime($this->updated_at));
    }
    public function coupon_end() {
        return date("d/m/Y", strtotime($this->coupon_end));
    }
}
