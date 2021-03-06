<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'name_qh', 'type', 'city_id'
    ];
    protected $primaryKey = 'id_qh';
 	protected $table = 'district';
}
