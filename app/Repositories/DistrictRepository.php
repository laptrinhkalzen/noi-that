<?php

namespace Repositories;

use Repositories\Support\AbstractRepository;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MarketingRepository
 *
 * @author Manh Hung
 */
class DistrictRepository extends AbstractRepository {

    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\District';
    }

    public function getAll() {
        return $this->model->where('status', 1)->get();
    }

}
