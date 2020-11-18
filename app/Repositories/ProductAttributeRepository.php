<?php
/**
 * Created by PhpStorm.
 * User: Hien
 * Date: 12/10/2019
 * Time: 11:50 AM
 */

namespace App\Repositories;


use Repositories\Support\AbstractRepository;

class ProductAttributeRepository extends AbstractRepository
{
    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\ProductAttribute';
    }
    public function getAttributes($product_id)
    {
        return $this->model->where('product_id', $product_id)->get();
    }
}