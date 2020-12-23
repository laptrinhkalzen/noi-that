<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Statistic;

use DB;
use App\Product;
use App\Supplier;
use App\Member;
use App\Coupon;
use App\Import;
use App\Contact;
use App\News;



class BackendController  extends Controller
{
    

       public function index() {
        //$coupons = $this->couponRepo->all();
            $product = Product::all()->count();
            $news = News::all()->count();
            $contact = Contact::all()->count();
            $bill = DB::table('bill')->count();
            $supplier = Supplier::all()->count();
            $member = Member::all()->count();
            $coupon = Coupon::all()->count();
            $import = DB::table('import')->count();
            $inventory = DB::table('inventory')->count();
        return view('backend/index',compact('product','bill','supplier','member','coupon','import','inventory','news','contact'));
    }


    public function filter_by_date(Request $request) {
        $data = $request->all();

        $from_date = $data['from_date'];
        $to_date = $data['to_date'];

        $get = Import::whereBetween('order_date',[$from_date, $to_date])->orderBy('order_date','ASC')->get();
    if(count($get)>1){
        $start = 0;
        $limit = 10;
        $import=DB::table('import')->whereBetween('order_date',[$from_date, $to_date])->limit($limit)->offset($start)->get();   
         $data= DB::table('import')->whereBetween('order_date',[$from_date, $to_date])->count();
         $total_page = ceil($data/$limit);    

         return response()->json(array('total_page'=>$total_page,'import'=>$import));
        
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
            $start = 0;
            $limit = 10;
            $import=DB::table('import')->whereBetween('order_date',[$sub7days,$now])->limit($limit)->offset($start)->get();   
             $data= DB::table('import')->whereBetween('order_date',[$sub7days,$now])->count();
             $total_page = ceil($data/$limit);    

         return response()->json(array('total_page'=>$total_page,'import'=>$import));
        }
        elseif($data['dashboard_value'] == 'thangtruoc'){
            
            $start = 0;
            $limit = 10;
            $import=DB::table('import')->whereBetween('order_date',[$dauthangtruoc,$cuoithangtruoc])->limit($limit)->offset($start)->get();   
             $data= DB::table('import')->whereBetween('order_date',[$dauthangtruoc,$cuoithangtruoc])->count();
             $total_page = ceil($data/$limit);    

         return response()->json(array('total_page'=>$total_page,'import'=>$import));
        }
        elseif($data['dashboard_value'] == 'thangnay'){
            
            $start = 0;
            $limit = 10;
            $import=DB::table('import')->whereBetween('order_date',[$dauthangnay,$now])->limit($limit)->offset($start)->get();   
             $data= DB::table('import')->whereBetween('order_date',[$dauthangnay,$now])->count();
             $total_page = ceil($data/$limit);  
             return response()->json(array('total_page'=>$total_page,'import'=>$import));
        }
        elseif($data['dashboard_value'] == '365ngayqua'){
            
            $start = 0;
            $limit = 10;
            $import=DB::table('import')->whereBetween('order_date',[$sub365days,$now])->limit($limit)->offset($start)->get();   
             $data= DB::table('import')->whereBetween('order_date',[$sub365days,$now])->count();
             $total_page = ceil($data/$limit);  
             return response()->json(array('total_page'=>$total_page,'import'=>$import));
        }else{
        return response()->json(['status'=>201]);
    }

    
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
        $start = 0;
        $limit = 10;
        $import=DB::table('import')->whereBetween('order_date',[$sub60days,$now])->limit($limit)->offset($start)->get();   
         $data= DB::table('import')->whereBetween('order_date',[$sub60days,$now])->count();
         $total_page = ceil($data/$limit); 

         return response()->json(array('chart_data'=>$chart_data,'total_page'=>$total_page,'import'=>$import));
        
    }
}
    else{
        return response()->json(['status'=>201]);
    }
}
    
      public function panigate(Request $request){
         $curent_page = $request->page;
         $limit = 10;
         $data= DB::table('import')->count();
         $total_page = ceil($data/$limit);    
          
          if($curent_page>$total_page){
            $curent_page = $total_page;
          }
          elseif ($curent_page<1) {
            $curent_page = 1;
          }
          $start = ($curent_page-1)*$limit;
          $import=DB::table('import')->limit($limit)->offset($start)->get();
         
          
    }



}