<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wards extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'name_xp', 'type', 'district_id'
    ];
    protected $primaryKey = 'id_xp';
 	protected $table = 'wards';
}
