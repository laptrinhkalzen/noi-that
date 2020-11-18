<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Marketing extends Authenticatable {

    use Notifiable;
    protected $table = 'marketing';
    protected $fillable = [
        'full_name', 'username', 'password', 'status', 'rank_id', 'alias', 'ref', 'activation', 'type', 'country_id', 'province_id', 'district_id', 'address','mobile','email','company_name','remember_token'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function created_at() {
        return date("d/m/Y", strtotime($this->created_at));
    }

    public function orders() {
        return $this->hasMany('\App\Order', 'ref', 'ref')->where('status',2);
    }
    public function rank(){
        return $this->belongsTo('\App\Rank');
    }
}
