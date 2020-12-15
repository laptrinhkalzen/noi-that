<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Statistic;
use TIMESTAMP;
use DB;
use App\Product;
use App\Supplier;
use App\Member;



class StatisticController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    

    public function index() {
        //$coupons = $this->couponRepo->all();
            $product = Product::all()->count();
            $bill = DB::table('bill')->count();
            $supplier = Supplier::all()->count();
            $member = Member::all()->count();
        return view('backend/statistic/index',compact('product','bill','supplier','member'));
    }


    public function filter_by_date(Request $request) {
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];

        $get = Statistic::whereBetween('order_date',[$from_date, $to_date])->orderBy('order_date','ASC')->get();
    if(count($get)>1){


        foreach ($get as $key => $val) {
            $chart_data[] = array(
                'period'=>$val->order_date,
                'order'=>$val->total_order,
                'sales'=>$val->sales,
                'profit'=>$val->profit,
                'quantity'=>$val->quantity,
            );
        }
        echo $data =json_encode($chart_data);
        
    }
    else{
        return response()->json(['status'=>201]);
    }
}

    
    public function fixed_filter(Request $request) {
        $data = $request->all();

        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');

        $dauthangnay= Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString(); 
        $dauthangtruoc= Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoithangtruoc= Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        if($data['dashboard_value'] == '7ngay'){
            $get = Statistic::whereBetween('order_date',[$sub7days,$now])->orderBy('order_date','ASC')->get();
        }
        elseif($data['dashboard_value'] == 'thangtruoc'){
            $get = Statistic::whereBetween('order_date',[$dauthangtruoc,$cuoithangtruoc])->orderBy('order_date','ASC')->get();
        }
        elseif($data['dashboard_value'] == 'thangnay'){
            $get = Statistic::whereBetween('order_date',[$dauthangnay,$now])->orderBy('order_date','ASC')->get();
        }
        else{
            $get = Statistic::whereBetween('order_date',[$sub365days,$now])->orderBy('order_date','ASC')->get();
        }

        

        
    if(count($get)>1){


        foreach ($get as $key => $val) {
            $chart_data[] = array(
                'period'=>$val->order_date,
                'order'=>$val->total_order,
                'sales'=>$val->sales,
                'profit'=>$val->profit,
                'quantity'=>$val->quantity,
            );
        }
        echo $data =json_encode($chart_data);
    }
    else{
        return response()->json(['status'=>201]);
    }
}

public function fixed_table(Request $request) {
        $data = $request->all();

        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');

        $dauthangnay= Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString(); 
        $dauthangtruoc= Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoithangtruoc= Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        if($data['dashboard_value'] == '7ngay'){
            $get = Statistic::whereBetween('order_date',[$sub7days,$now])->orderBy('order_date','ASC')->get();
        }
        elseif($data['dashboard_value'] == 'thangtruoc'){
            $get = Statistic::whereBetween('order_date',[$dauthangtruoc,$cuoithangtruoc])->orderBy('order_date','ASC')->get();
        }
        elseif($data['dashboard_value'] == 'thangnay'){
            $get = Statistic::whereBetween('order_date',[$dauthangnay,$now])->orderBy('order_date','ASC')->get();
        }
        else{
            $get = Statistic::whereBetween('order_date',[$sub365days,$now])->orderBy('order_date','ASC')->get();
        }

        

        
    if(count($get)>1){


        foreach ($get as $key => $val) {
            $chart_data[] = array(
                'period'=>$val->order_date,
                'order'=>$val->total_order,
                'sales'=>$val->sales,
                'profit'=>$val->profit,
                'quantity'=>$val->quantity,
            );
        }
        
           
        return $chart_data;
    }
    else{
        return response()->json(['status'=>201]);
    }
}


    public function inventory() {
            //$coupons = $this->couponRepo->all();
            $inventory_products = DB::table('inventory_product')->join('inventory','inventory.inventory_id','=','inventory_product.inventory_id')->get();
            $products = DB::table('product')->get();
            return view('backend/statistic/inventory',compact('products','inventory_products'));
        }
     
      public function days_order(Request $request) {
        $data = $request->all();

        
        $sub60days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(60)->toDateString();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        
        $get = Statistic::whereBetween('order_date',[$sub60days,$now])->orderBy('order_date','ASC')->get();
  
        
    if(count($get)>1){


        foreach ($get as $key => $val) {
            $chart_data[] = array(
                'period'=>$val->order_date,
                'order'=>$val->total_order,
                'sales'=>$val->sales,
                'profit'=>$val->profit,
                'quantity'=>$val->quantity,
            );
        }
        echo $data =json_encode($chart_data);
    }
    else{
        return response()->json(['status'=>201]);
    }
}
    // public function addPostHistory($product) {

    //     $post_history['item_id'] = $product->id;
    //     $post_history['created_at'] = $product->created_at;
    //     $post_history['updated_at'] = $product->post_schedule ?: $product->updated_at;
    //     $post_history['module'] = 'product';
    //     $this->postHistoryRepo->create($post_history);
    // }

}
