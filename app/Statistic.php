<?php

namespace App;

// use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Foundation\Auth\User as Authenticatable
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
	
    protected $table = 'statistical';
    protected $fillable = ['order_date','sales','profit','quantity', 'total_order'];
    protected $primaryKey ='statistical_id';
   
  
}
