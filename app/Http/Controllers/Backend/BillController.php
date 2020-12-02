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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(StockRepository $stockRepo) {
        $this->stockRepo = $stockRepo;
        
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     //tao moi hoa don
     
    public function index(){
        $records=DB::table('bill')->get();
        $stocks=DB::table('stock')->get();
        return view('backend/bill/index',compact('records','stocks'));
    }

    public function create($stock_id){
        $customers=DB::table('member')->get();
        $users=DB::table('user')->get();

        $products=DB::table('product')->join('stock_product','product.id','=','stock_product.product_id')->where('stock_id',$stock_id)->get();
        $stocks=DB::table('stock')->get();
        $suppliers=DB::table('supplier')->get();
        // $members=DB::table('member')->orderBy('created_at', 'desc')->get();
        return view('backend/bill/create',compact('products','suppliers','stocks','users','customers','stock_id'));
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

        // $members=DB::table('member')->orderBy('created_at', 'desc')->get();
        return redirect()->route('admin.bill.index1')->with('success','Thành công');
    }
     public function edit($id,$stock_id){
        $bill=DB::table('bill')->where('bill_id',$id)->first();
        $customers=DB::table('member')->get();
        $users=DB::table('user')->get();
        $bill_products=DB::table('product')->join('bill_product','bill_product.product_id','=','product.id')->where('bill_id',$id)->get();
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
        return redirect()->route('admin.bill.index1')->with('success','Thành công');
    }

    public function destroy($id) {
        DB::table('bill')->where('bill_id',$id)->delete();
        DB::table('bill_product')->where('bill_id',$id)->delete();
        return redirect()->back()->with('success', 'Xóa thành công');
    }
}