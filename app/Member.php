<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
    protected $table = 'member';
    protected $fillable = ['username','email', 'password','status','full_name','company_name','mobile','address','country_id','city_id','province_id','facebook_id','google_id','activation'];
    public function created_at() {
        return date("d/m/Y", strtotime($this->created_at));
    }
}
