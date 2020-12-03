<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Repositories\StockRepository;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use TIMESTAMP;
use DB;
use Auth;

//stock_id=$request->stock_id => stock_id=1
class StockController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(StockRepository $stockRepo) {
        $this->stockRepo = $stockRepo;
        
    }

    public function index() {
        
       
        $stocks = $this->stockRepo->all();
        
        return view('backend/stock/index', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
      

        return view('backend/stock/create');
    }

    
     

     //nhap kho
     
    public function import_index(){
        $records=DB::table('import')->join('stock','import.stock_id','=','stock.id')->join('supplier','import.supplier_id','=','supplier.id')->join('user','user.id','=','import.created_by')->get();
    

        return view('backend/stock/import_index',compact('records'));
    }

    public function import_create() {
        $products=DB::table('product')->get();
        $stocks=DB::table('stock')->get();
        $suppliers=DB::table('supplier')->get();
        // $members=DB::table('member')->orderBy('created_at', 'desc')->get();
        return view('backend/stock/import_create',compact('products','suppliers','stocks'));
    }

     public function import_edit($id) {
        $products=DB::table('product')->get();

        $stocks=DB::table('stock')->get();
        $suppliers=DB::table('supplier')->get();
        $import=DB::table('import')->where('import_id',$id)->first();
        $import_products=DB::table('import_product')->where('import_id',$id)->get();

        // $members=DB::table('member')->orderBy('created_at', 'desc')->get();
        return view('backend/stock/import_edit',compact('products','suppliers','stocks','import','import_products'));
    }
    
     public function import_store(Request $request) {
           $product=$request->product;
           $quantity=$request->quantity;
           $import_price=$request->import_price;
           $sub_total=$request->sub_total;
             
           $import=array();
           $import['stock_id']=1;
           $import['supplier_id']=$request->supplier;
           $import['created_at']=Carbon::now('Asia/Ho_Chi_Minh');
           $import['note']=$request->note;
           $import['payment_type']=$request->payment_type;
           $import['discount_type']=$request->discount_type;
           $import['discount']=$request->discount;
           $import['total_payment']=$request->total_payment;
           $import['total']=$request->total;
           $import['paid']=$request->paid;
           $import['payment_remain']=$request->total_payment-$request->paid;
           $import['payment_day']=$request->payment_day;
           $import['bill_type']=1;
           $import['created_by']=Auth::user()->id;
           $id=DB::table('import')->insertGetId($import);

         
          
            for($count=0;$count<count($product);$count++){
                //$products=DB::table('product')->where('id',$product[$count])->first();
                // if($import_price[$count] != $products->price){
                //     DB::table('product')->where('id',$product[$count])->update(['price' => $import_price[$count]]);
                // }
                $import_product=array(
                'stock_product_id'=>$request->stock,  
                'product_id'=>$product[$count],
                'import_id'=>$id,
                'quantity'=>$quantity[$count],
                'import_price'=>$import_price[$count],
                'sub_total'=>$sub_total[$count]
                );
                $insert_data[]=$import_product;
            }
            DB::table('import_product')->insert($insert_data);
             
              for($count=0;$count<count($product);$count++){
                 $product_update=DB::table('product')->where('id',$product[$count])->first();
                 $stock_pro=DB::table('stock_product')->where('product_id',$product[$count])->get();
                 $sum=0;
                 foreach($stock_pro as $stock_pro1){
                    $sum+=$stock_pro1->stock_product_quantity;
                 }
                 
                if($product_update->price != $import_price[$count]){

                    $new_price=(($product_update->price*$sum)+($import_price[$count]*$quantity[$count]))/($sum+$quantity[$count]);
                    
                    DB::table('product')->where('id',$product[$count])->update(['price'=>$new_price]);
                }
            }

             
            //   for($count=0;$count<count($product);$count++){
            //      $product_update=DB::table('product')->where('id',$product[$count])->first();
            //      $stock_pro=DB::table('stock_product')->where('product_id',$product[$count])->get();
            //      $sum=0;
            //      foreach($stock_pro as $stock_pro1){
            //         $sum+=$stock_pro1->stock_product_quantity;
            //      }
                 
            //     if($product_update->price != $import_price[$count]){

            //         $new_price=(($product_update->price*$sum)+($import_price[$count]*$quantity[$count]))/($sum+$quantity[$count]);
                    
            //         DB::table('product')->where('id',$product[$count])->update(['price'=>$new_price]);
            //     }
            // }



             for($count=0;$count<count($product);$count++){
                $is_exist=DB::table('stock_product')->where('product_id',$product[$count])->where('stock_id',1)->first();
                if($is_exist){
                  $stock_product=array();
                  $stock_product['stock_product_quantity']=$is_exist->stock_product_quantity + $quantity[$count];
                  DB::table('stock_product')->where('product_id',$product[$count])->update(['stock_product_quantity'=> $stock_product['stock_product_quantity']]);
                  }
                else{
                  $stock_product=array();
                  $stock_product['stock_id']=1;
                  $stock_product['product_id']=$product[$count];
                  $stock_product['stock_product_quantity']=$quantity[$count];
                  DB::table('stock_product')->insert($stock_product);
                  } 
                }  

       if($request->print1!=1){

        return redirect()->route('admin.import.index')->with('success','Thành công');
      }else
      {
        return redirect()->route('admin.print.edit_import',['id'=>$id])->with('success','Thành công');
      }
    }

         public function import_update(Request $request,$id) {
           $product=$request->product;
           $quantity=$request->quantity;
           $import_price=$request->import_price;
           $sub_total=$request->sub_total;

               for($count=0;$count<count($product);$count++){
                $is_exist=DB::table('import_product')->where('import_id',$id)->where('product_id',$product[$count])->first();
                if($is_exist==null){
                 $product_update=DB::table('product')->where('id',$product[$count])->first();
                 $stock_pro=DB::table('stock_product')->where('product_id',$product[$count])->get();
                 $sum=0;
                 foreach($stock_pro as $stock_pro1){
                    $sum+=$stock_pro1->stock_product_quantity;
                 }
                if($product_update->price != $import_price[$count]){
                    $new_price=(($product_update->price*$sum)+($import_price[$count]*$quantity[$count]))/($sum+$quantity[$count]);
                    DB::table('product')->where('id',$product[$count])->update(['price'=>$new_price]);
                }
              }
            }

           $import=array();
           $import['stock_id']=1;
           $import['supplier_id']=$request->supplier;
           $import['created_at']=Carbon::now('Asia/Ho_Chi_Minh');
           $import['note']=$request->note;
           $import['payment_type']=$request->payment_type;
           $import['discount_type']=$request->discount_type;
           $import['discount']=$request->discount;
           $import['total_payment']=$request->total_payment;
           $import['total']=$request->total;
           $import['paid']=$request->paid;
           $import['payment_remain']=$request->total_payment-$request->paid;
           $import['payment_day']=$request->payment_day;
           DB::table('import')->where('import_id',$id)->update($import);
          
          //cap nhat gia nhap

         
          //san pham trong don nhap hang
           DB::table('import_product')->where('import_id',$id)->delete();
            for($count=0;$count<count($product);$count++){
              $is_exist=DB::table('import_product')->where('import_id',$id)->where('product_id',$product[$count])->first();
              if($is_exist){
                $update_data=array();
                $update_data['quantity']=$quantity[$count];
                $update_data['import_price']=$import_price[$count];
                $update_data['sub_total']=$sub_total[$count];
                  DB::table('import_product')->where('import_id',$id)->where('product_id',$product[$count])->update($update_data);
              }
              else{
                $import_product=array(
                'stock_product_id'=>$request->stock,  
                'product_id'=>$product[$count],
                'import_id'=>$id,
                'quantity'=>$quantity[$count],
                'import_price'=>$import_price[$count],
                'sub_total'=>$sub_total[$count]
                );

                $insert_data[]=$import_product;
                }
            }
            DB::table('import_product')->insert($insert_data);
             
             
             //them quantity product trong tung kho
             for($count=0;$count<count($product);$count++){
                $is_exist=DB::table('stock_product')->where('product_id',$product[$count])->where('stock_id',1)->first();
                if($is_exist){
                  $stock_product=array();
                  $stock_product['stock_product_quantity']=$is_exist->stock_product_quantity + $quantity[$count];
                  DB::table('stock_product')->where('product_id',$product[$count])->update(['stock_product_quantity'=> $stock_product['stock_product_quantity']]);
                  }
                else{
                  $stock_product=array();
                  $stock_product['stock_id']=1;
                  $stock_product['product_id']=$product[$count];
                  $stock_product['stock_product_quantity']=$quantity[$count];
                  DB::table('stock_product')->insert($stock_product);
                  } 
                }  
       if($request->print1!=1){

        return redirect()->route('admin.import.index')->with('success','Thành công');
      }else
      {
        return redirect()->route('admin.print.edit_import',['id'=>$id])->with('success','Thành công');
      }
    }

     public function print($id){
      $print_imports=DB::table('import_product')->join('product','product.id','=','import_product.product_id')->where('import_id',$id)->get();
      $imports=DB::table('import')->where('import_id',$id)->first();
      
      $total=0;
      foreach ($print_imports as $key => $import) {
        $total=$total+$import->sub_total;

      }
      

      
      $stocks=DB::table('stock')->where('id',$imports->stock_id)->first();
      $suppliers=DB::table('supplier')->where('id',$imports->supplier_id)->first();
      return view('backend/stock/print_import')->with('print_imports',$print_imports)->with('imports',$imports)->with('stocks',$stocks)->with('total',$total)->with('suppliers',$suppliers);
    }

     
     public function import_product(){
       $records=DB::table('import_product')->join('product','import_product.product_id','=','product.id')->get();

       return view('backend/stock/import_product',compact('records'));
     }

    //xuat kho
    public function export_create($id) {
        $stock_products=DB::table('stock_product')->get();
        $stocks=DB::table('stock')->get();
        $suppliers=DB::table('supplier')->get();
        // $members=DB::table('member')->orderBy('created_at', 'desc')->get();
        return view('backend/stock/export_create',compact('suppliers','stocks','id','stock_products'));
    }


    public function stock_product(){
        $records=DB::table('stock_product')->join('product','product.id','=','stock_product.product_id')->where('stock_id',1)->get();
        return view('backend/stock/stock_product',compact('records'));
    }
     


   
    public function store(Request $request) {
        $input = $request->all();
        $validator = \Validator::make($input, $this->stockRepo->validateCreate());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
          $stock = $this->stockRepo->create($input);
        if ($stock) {
            return redirect()->route('admin.stock.index')->with('success', 'Tạo mới thành công');
        } else {
            return redirect()->route('admin.stock.index')->with('error', 'Tạo mới thất bại');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
         $stock = $this->stockRepo->find($id);
        return view('backend/stock/update')->with('stock',$stock);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $input = $request->all();
        $validator = \Validator::make($input, $this->stockRepo->validateUpdate($id));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
       
         $res = $this->stockRepo->update($input, $id);
        if ($res) {
            return redirect()->route('admin.stock.index')->with('success', 'Cập nhật thành công');
        } else {
            return redirect()->route('admin.stock.index')->with('error', 'Cập nhật thất bại');
        }
        dd($input);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function import_destroy($id) {
        DB::table('import')->where('import_id',$id)->delete();
        DB::table('import_product')->where('import_id',$id)->delete();
        return redirect()->back()->with('success', 'Xóa thành công');
    }

    public function destroy($id) {
        $stock = $this->stockRepo->find($id);
        $this->stockRepo->delete($id);
        return redirect()->back()->with('success', 'Xóa thành công');
    }

}