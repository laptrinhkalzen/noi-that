<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\StringHelper;
use App\Repositories\OrderRepository;
use DB;

class BackendController extends Controller {

    public function __construct(OrderRepository $orderRepo) {
        $this->orderRepo = $orderRepo;
    }

    public function slugify(Request $request) {
        return response()->json(['alias' => StringHelper::slug($request->get('title'))]);
    }

    public function changeStatus(Request $request) {
       // $coupon_code=$request->coupon_code;
       //      $query=DB::table('coupon')->where('coupon_code',$coupon_code)->first();
            
       //      if ($query){
       //          return response()->json(array('success' => true,"statusCode"=>200,"value"=>$query->coupon_value));
       //      }
       //      else{
       //            return response()->json(array("statusCode"=>201));
               
       //      }
        $coupon_code=$request->coupon_code;
        $check=DB::table('coupon')->where('coupon_code',$coupon_code)->first();
        return response()->json(['success'=>true,'coupon_code'=>$check->coupon_value]);
      
    }

    public function apply_coupon(Request $request)
    {

            
        $discounted_price=  100;

        $result->val = $discounted_price;
       
        return json_encode($result);

    }

}
