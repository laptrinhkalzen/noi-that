<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Repositories\StockRepository;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use TIMESTAMP;
use DB;
use Auth;


class BillController extends Controller {
   const API_BASE_URL             = 'http://api.trackingmore.com/v2/';
    const ROUTE_CARRIERS           = 'carriers/';
  const ROUTE_CARRIERS_DETECT    = 'carriers/detect';
    const ROUTE_TRACKINGS          = 'trackings';
  const ROUTE_LIST_ALL_TRACKINGS = 'trackings/get';
  const ROUTE_CREATE_TRACKING    = 'trackings/post';
    const ROUTE_TRACKINGS_BATCH    = 'trackings/batch'; 
  const ROUTE_TRACKINGS_REALTIME = 'trackings/realtime';
  const ROUTE_TRACKINGS_RELETE   = 'trackings/delete';
  const ROUTE_TRACKINGS_UPDATE   = 'trackings/update';
  const ROUTE_TRACKINGS_GETUSEINFO = 'trackings/getuserinfo';
  const ROUTE_TRACKINGS_GETSTATUS = 'trackings/getstatusnumber';
  const ROUTE_TRACKINGS_NOTUPDATE = 'trackings/notupdate';
  const ROUTE_TRACKINGS_REMOTE   = 'trackings/remote';
  const ROUTE_TRACKINGS_COSTTIME   = 'trackings/costtime';
  const ROUTE_TRACKINGS_UPDATEMORE   = 'trackings/updatemore';
    protected $apiKey              = 'd86764c2-6ea1-4390-a882-2011f434f994';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(StockRepository $stockRepo) {
        $this->stockRepo = $stockRepo;
        
    }
        protected function _getApiData($route, $method = 'GET', $sendData = array()){
    $method     = strtoupper($method);
        $requestUrl = self::API_BASE_URL.$route;
        $curlObj    = curl_init();
        curl_setopt($curlObj, CURLOPT_URL,$requestUrl);
    if($method == 'GET'){
            curl_setopt($curlObj, CURLOPT_HTTPGET,true);
        }elseif($method == 'POST'){
            curl_setopt($curlObj, CURLOPT_POST, true);
        }elseif ($method == 'PUT'){
            curl_setopt($curlObj, CURLOPT_CUSTOMREQUEST, "PUT");
        }else{
      curl_setopt($curlObj, CURLOPT_CUSTOMREQUEST, $method); 
    }
      
        curl_setopt($curlObj, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($curlObj, CURLOPT_TIMEOUT, 90);

        curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlObj, CURLOPT_HEADER, 0);
        $headers = array(
            'Trackingmore-Api-Key: ' . $this->apiKey,
            'Content-Type: application/json',
        ); 
        if($sendData){
            $dataString = json_encode($sendData);
            curl_setopt($curlObj, CURLOPT_POSTFIELDS, $dataString);
            $headers[] = 'Content-Length: ' . strlen($dataString);
        }
        curl_setopt($curlObj, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($curlObj);
        curl_close($curlObj);
        unset($curlObj); 
        return $response;
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     //tao moi hoa don
    public function createMultipleTracking($multipleData){
        $returnData = array();
    $sendData   = array();
        $requestUrl = self::ROUTE_TRACKINGS_BATCH; 
    if(!empty($multipleData)){
      foreach($multipleData as $val){
        $items                         = array();
          $items['tracking_number']      = !empty($val['tracking_number'])?$val['tracking_number']:null;
        $items['carrier_code']         = !empty($val['carrier_code'])?$val['carrier_code']:null;
        $items['title']                = !empty($val['title'])?$val['title']:null;
        $items['logistics_channel']    = !empty($val['logistics_channel'])?$val['logistics_channel']:null;
        $items['customer_name']        = !empty($val['customer_name'])?$val['customer_name']:null;
        $items['customer_email']       = !empty($val['customer_email'])?$val['customer_email']:null;
        $items['order_id']             = !empty($val['order_id'])?$val['order_id']:null;
        $items['destination_code']     = !empty($val['destination_code'])?$val['destination_code']:null;
        $items['customer_phone']       = !empty($val['customer_phone'])?$val['customer_phone']:null;
        $items['order_create_time']    = !empty($val['order_create_time'])?$val['order_create_time']:null;
        $items['tracking_ship_date']   = !empty($val['tracking_ship_date'])?$val['tracking_ship_date']:null;
        $items['tracking_postal_code'] = !empty($val['tracking_postal_code'])?$val['tracking_postal_code']:null;
        $items['specialNumberDestination'] = !empty($val['specialNumberDestination'])?$val['specialNumberDestination']:null;
        $items['lang']                 = !empty($val['lang'])?$val['lang']:'en';
                $sendData[]                    = $items;
      }
    }
    
        $result = $this->_getApiData($requestUrl, 'POST', $sendData); 
        if ($result) {
            $returnData = json_decode($result, true);
        }
        return $returnData;
    }
     
    public function index(){
        $records=DB::table('bill')->get();
        $stocks=DB::table('stock')->get();
        return view('backend/bill/index',compact('records','stocks'));
    }

    public function createTracking($carrierCode,$trackingNumber,$extraInfo = array()){
        $returnData = array();
    $sendData   = array();
        $requestUrl = self::ROUTE_CREATE_TRACKING; 
    
    $sendData['tracking_number']      = $trackingNumber;
    $sendData['carrier_code']         = $carrierCode;
    $sendData['title']                = !empty($extraInfo['title'])?$extraInfo['title']:null;
    $sendData['logistics_channel']    = !empty($extraInfo['logistics_channel'])?$extraInfo['logistics_channel']:null;
    $sendData['customer_name']        = !empty($extraInfo['customer_name'])?$extraInfo['customer_name']:null;
    $sendData['customer_email']       = !empty($extraInfo['customer_email'])?$extraInfo['customer_email']:null;
    $sendData['order_id']             = !empty($extraInfo['order_id'])?$extraInfo['order_id']:null;
    $sendData['customer_phone']       = !empty($extraInfo['customer_phone'])?$extraInfo['customer_phone']:null;
    $sendData['order_create_time']    = !empty($extraInfo['order_create_time'])?$extraInfo['order_create_time']:null;
    $sendData['destination_code']     = !empty($extraInfo['destination_code'])?$extraInfo['destination_code']:'';
    $sendData['tracking_ship_date']   = !empty($extraInfo['tracking_ship_date'])?$extraInfo['tracking_ship_date']:null;
    $sendData['tracking_postal_code'] = !empty($extraInfo['tracking_postal_code'])?$extraInfo['tracking_postal_code']:"";
    $sendData['lang']                 = !empty($extraInfo['lang'])?$extraInfo['lang']:"en";

        $result = $this->_getApiData($requestUrl, 'POST', $sendData);
        if ($result) {
            $returnData = json_decode($result, true);
        }
        return $returnData;
    }
     public function getCarrierList(){
        $returnData = array();
        $requestUrl = self::ROUTE_CARRIERS; 
        $result = $this->_getApiData($requestUrl, 'GET');
        if ($result) {
            $returnData = json_decode($result, true);
        }
        return $returnData;
    }
    public function create($stock_id){
        $customers=DB::table('member')->get();
        $users=DB::table('user')->get();
        $city=DB::table('city')->get();
        $district=DB::table('district')->get();
        $wards=DB::table('wards')->get();
        $products=DB::table('product')->join('stock_product','product.id','=','stock_product.product_id')->where('stock_id',$stock_id)->get();
        $stocks=DB::table('stock')->get();
        $suppliers=DB::table('supplier')->get();
        // $members=DB::table('member')->orderBy('created_at', 'desc')->get();
        return view('backend/bill/create',compact('products','suppliers','stocks','users','customers','stock_id','city','district','wards'));
    }

    public function store($stock_id, Request $request){
           $product=$request->product;
           $quantity=$request->quantity;
           $price=$request->price;
           $sub_total=$request->sub_total;
           $import=array();
           $import['stock_id']=$stock_id;
           $import['stock_name']=DB::table('stock')->where('id',$stock_id)->pluck('name')->first();
           $import['total']=$request->total;
           $import['created_at']=Carbon::now('Asia/Ho_Chi_Minh');
           $import['order_date']=Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
           $import['note']=$request->note;
           $import['status']=1;
           $import['total_payment']=$request->total_payment;
           $import['user_id']=$request->user_id;
           $import['customer_id']=$request->customer_id;
           $import['customer_name']=DB::table('member')->where('id',$request->customer_id)->pluck('full_name')->first();
           $import['user_name']=DB::table('user')->where('id',$request->user_id)->pluck('full_name')->first();
           $import['discount']=$request->discount;
           $import['coupon']=$request->coupon;
           $import['customer_payment']=$request->customer_payment;
           $import['payment_appointment']=$request->payment_appointment;
           $import['payment_remain']=$request->total_payment-$request->customer_payment;
           $import['city']=$request->city;
           $import['district']=$request->district;
           $import['wards']=$request->wards;
           $import['address']=$request->address;
           $import['type_payment']=$request->type_payment;
           $import['shipping']=$request->shipping;
           $bill_id=DB::table('bill')->insertGetId($import);

            for($count=0;$count<count($product);$count++){
                $quantity_in_stock=DB::table('stock_product')->where('stock_id',$stock_id)->where('product_id',$product[$count])->pluck('stock_product_quantity')->first();
                DB::table('stock_product')->where('stock_id',$stock_id)->where('product_id',$product[$count])->update(['stock_product_quantity' => ($quantity_in_stock-$quantity[$count])]);
                $import_product=array(
                'bill_id'=>$bill_id, 
                'product_id'=>$product[$count],
                'price'=>$price[$count],
                'quantity'=>$quantity[$count],
                'sub_total'=>$sub_total[$count]
                );
                $insert_data[]=$import_product;
            }
            DB::table('bill_product')->insert($insert_data);
                $extraInfo                         = array();
                $extraInfo['title']                = 'iphone6';
                $extraInfo['logistics_channel']   = '4PX挂号小包';
                $extraInfo['customer_name']        = 'charse chen';
                $extraInfo['customer_email']       = 'chasechen@gmail.com';
                $extraInfo['order_id']             = '8988787987';
                $extraInfo['customer_phone']       = '86 13873399982';
                $extraInfo['order_create_time']    = '2018-05-11 12:00';
                $extraInfo['destination_code']     = 'VN';
                $extraInfo['tracking_ship_date']   = time();
                $extraInfo['tracking_postal_code'] = '13ES21';
                $extraInfo['lang']                 = 'vn';
                $track =$this->createTracking('viettelpost','RM1215122167N',$extraInfo);
        // $members=DB::table('member')->orderBy('created_at', 'desc')->get();
        if($request->print1!=1){

        return redirect()->route('admin.bill.index1')->with('success','Thành công');
      }else
      {
        return redirect()->route('admin.print.edit_bill',['id'=>$bill_id])->with('success','Thành công');
      }
    }
     public function edit($id,$stock_id){
        $bill=DB::table('bill')->where('bill_id',$id)->first();
        $customers=DB::table('member')->get();
        $users=DB::table('user')->get();
         $bill_products=DB::table('product')->join('bill_product','bill_product.product_id','=','product.id')->where('bill_id',$id)->get();
        //$print_products=DB::table('product')->join('bill_product','bill_product.product_id','=','product.id')->where('bill_id',$id)->get();
        $stock_products=DB::table('stock_product')->where('stock_id',$stock_id)->get();
        $products=DB::table('product')->join('stock_product','product.id','=','stock_product.product_id')->where('stock_id',$stock_id)->get();
        // $members=DB::table('member')->orderBy('created_at', 'desc')->get();
        return view('backend/bill/edit',compact('bill','customers','users','bill_products','stock_products','products'));
    }

    public function update(Request $request,$id,$stock_id){
           $product=$request->product;
           $quantity=$request->quantity;
           $price=$request->price;
           $sub_total=$request->sub_total;

           $import=array();
           $import['total']=$request->total;
           $import['note']=$request->note;
           $import['total_payment']=$request->total_payment;
           $import['user_id']=$request->user_id;
           $import['customer_id']=$request->customer_id;
           $import['customer_name']=DB::table('member')->where('id',$request->customer_id)->pluck('full_name')->first();
           $import['user_name']=DB::table('user')->where('id',$request->user_id)->pluck('full_name')->first();
           $import['discount']=$request->discount;
           $import['coupon']=$request->coupon;
           $import['customer_payment']=$request->customer_payment;
           $import['payment_appointment']=$request->payment_appointment;
           $import['payment_remain']=$request->total_payment-$request->customer_payment;
           $import['order_date']=Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            DB::table('bill')->where('bill_id',$id)->update($import);

            //cap nhat so luong hàng trong kho
            $product_quantity=DB::table('bill_product')->where('bill_id',$id)->get();
            foreach($product_quantity as $value){
                $quantity_in_stock1=DB::table('stock_product')->where('stock_id',$stock_id)->where('product_id',$value->product_id)->pluck('stock_product_quantity')->first();
                DB::table('stock_product')->where('stock_id',$stock_id)->where('product_id',$value->product_id)->update(['stock_product_quantity' => ($quantity_in_stock1+$value->quantity)]);
            }

            //cap nhat lại variant
            DB::table('bill_product')->where('bill_id',$id)->delete();
            for($count=0;$count<count($price);$count++){
                 $quantity_in_stock=DB::table('stock_product')->where('stock_id',$stock_id)->where('product_id',$product[$count])->pluck('stock_product_quantity')->first();
                DB::table('stock_product')->where('stock_id',$stock_id)->where('product_id',$product[$count])->update(['stock_product_quantity' => ($quantity_in_stock-$quantity[$count])]);
                $import_product=array(
                'bill_id'=>$id, 
                'product_id'=>$product[$count],
                'price'=>$price[$count],
                'quantity'=>$quantity[$count],
                'sub_total'=>$sub_total[$count]
                );
                $insert_data[]=$import_product;
            }
            DB::table('bill_product')->insert($insert_data);

        // $members=DB::table('member')->orderBy('created_at', 'desc')->get();
            if($request->print!=1){

        return redirect()->route('admin.bill.index1')->with('success','Thành công');
      }else
      {
        return redirect()->route('admin.print.edit_bill',['id'=>$id])->with('success','Thành công');
      }
    }

    public function update_status($id,$status){
      DB::table('bill')->where('bill_id',$id)->update(['status'=>$status]);
      return redirect()->back()->with('success','Thành công');
    }

    public function destroy($id) {
        DB::table('bill')->where('bill_id',$id)->delete();
        DB::table('bill_product')->where('bill_id',$id)->delete();
        return redirect()->back()->with('success', 'Xóa thành công');
    }
    public function print($id){
      $print_products=DB::table('bill_product')->join('product','product.id','=','bill_product.product_id')->where('bill_id',$id)->get();
      $bills=DB::table('bill')->where('bill_id',$id)->first();
      $total=0;
      foreach ($print_products as $key => $product) {
        $total=$total+$product->sub_total;
       
      }

      $customers=DB::table('member')->where('id',$bills->customer_id)->first();
      
      return view('backend/bill/print')->with('print_products',$print_products)->with('bills',$bills)->with('customers',$customers)->with('total',$total);
    }
}