<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'name_tp', 'type'
    ];
    protected $primaryKey = 'id_tp';
 	protected $table = 'city';
}
