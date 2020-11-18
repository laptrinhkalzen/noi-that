<?php

namespace Repositories;

use Repositories\Support\AbstractRepository;

class MarketingRepository extends AbstractRepository {

    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\Marketing';
    }

     public function validateCreate() {
        return $rules = [
             'username' => 'required|unique:marketing',
        ];
    }
    public function validate() {
        return $rules = [
            'full_name' => 'required',
            'alias' => 'required',
            'email' => 'required',
            'mobile' => 'required'
        ];
    }
    public function checkUser($username){
        return $this->model->where('username',$username)->first();
    }
    public function countUser(){
        return $this->model->count();
    }
    public function checkactivation($key){
         return $this->model->where('activation',$key)->first();
    }
    public function getData($request,$id){
       $query = $this->model;
       //dd(date('Y-m-d',strtotime($request->get('end_date'))));
       if(($request->get('start_date_submit'))){
          $query = $query->whereDate('order.created_at','>=',date('Y-m-d',strtotime($request->get('start_date_submit'))));
       }
       if(($request->get('end_date_submit'))){
          $query = $query->whereDate('order.created_at','<=',date('Y-m-d',strtotime($request->get('end_date_submit'))));
       }
       $data = $query->join('order','order.ref','marketing.ref')->join('rank','rank.id','marketing.rank_id')->where('marketing.id',$id)->where('order.status',2)->select('order.created_at','order.id','order.total','rank.discount_percent')->get();
       return $data;
   }
}
