<?php

namespace App\Repositories;

use Repositories\Support\AbstractRepository;

class StockRepository extends AbstractRepository {

    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\Stock';
    }

    public function validateCreate() {
        return $rules = [
            'name' => 'required|unique:supplier',
            
            
        ];
    }

    public function validateUpdate($id) {
        return $rules = [
            'name' => 'required',
            
            ];
    }

    


}
