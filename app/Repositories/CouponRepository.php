<?php

namespace App\Repositories;

use Repositories\Support\AbstractRepository;

class CouponRepository extends AbstractRepository {

    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\Coupon';
    }

    public function validateCreate() {
        return $rules = [
            'coupon_name' => 'required|unique:coupon',
            'coupon_code' => 'required|unique:coupon',
            'coupon_number' => 'required',
            'coupon_type' => 'required',
            'coupon_value' => 'required',
            'coupon_end' => 'required'

        ];
    }

    public function validateUpdate($id) {
        return $rules = [
            
            'coupon_number' => 'required',
            'coupon_type' => 'required',
            'coupon_value' => 'required',
            
        ];
    }

    
}
