<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Repositories\InventoryRepository;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use TIMESTAMP;
use DB;
use Auth;


class InventoryController extends Controller {

    
  

    public function index() {
        $categorys=DB::table('category')->get();
        $records=DB::table('inventory')->get();
        return view('backend/inventory/index', compact('records','categorys'));
    }

   
    public function create($type,$category) {
       

          if($type==1){
            $users=DB::table('user')->get();
            $products=DB::table('stock_product')->join('product','product.id','=','stock_product.product_id')->where('stock_id',1)->orderBy('stock_product_id','desc')->get();
            return view('backend/inventory/create_product',compact('products','users'));
          }
          if($type==2){  
            $users=DB::table('user')->get();
             $products=DB::table('stock_product')->join('product','product.id','=','stock_product.product_id')->where('stock_id',1)->orderBy('stock_product_id','desc')->get();
            return view('backend/inventory/create',compact('users','products'));
          }
          if($type==3){
            $records=DB::table('stock_product')->join('product_category','product_category.product_id','=','stock_product.')->where('stock_product_id',1)->where('stock_product_id',1)->orderBy('stock_product_id','desc')->get();
            return view('backend/inventory/create');
          }
        return view('backend/inventory/create',compact('records'));
    }

    public function store(Request $request)
    {   

         $data=array();
         $data['user_id']=$request->user_id;
         $data['created_at']=Carbon::now('Asia/Ho_Chi_Minh');
         $data['user_name']=DB::table('user')->where('id',$request->user_id)->pluck('full_name')->first();
         $data['inventory_note']=$request->note;
         $id=DB::table('inventory')->insertGetId($data);

         $product=$request->product;
         $exist=$request->exist;
         $real=$request->real;
         $difference=$request->difference;
         for($count=0;$count<count($product);$count++){
             $insert_data=array(
                'inventory_id'=>$id,
                'product_id'=>$product[$count],
                'exist'=>$exist[$count],
                'real'=>$real[$count],
                'difference'=>$difference[$count]
             );
             $inventory_product[]=$insert_data;
         }
         DB::table('inventory_product')->insert($inventory_product);
         return redirect()->route('admin.inventory.index')->with('success','Thành công');
    }

    
    public function edit($id) {
        $users=DB::table('user')->get();
        $inventory=DB::table('inventory')->where('inventory_id',$id)->first();
        $inventory_products=DB::table('inventory_product')->join('product','inventory_product.product_id','=','product.id')->where('inventory_id',$id)->get();

    
        return view('backend/inventory/edit')->with('inventory_products',$inventory_products)->with('inventory',$inventory)->with('users',$users);
    }

  
     
    public function update(Request $request, $id) {
         
         
      $data=array();
         $data['user_id']=$request->user_id;
         $data['user_name']=DB::table('user')->where('id',$request->user_id)->pluck('full_name')->first();
         $data['inventory_note']=$request->note;
         DB::table('inventory')->where('inventory_id',$id)->update($data);

         $product=$request->product;
         $exist=$request->exist;
         $real=$request->real;
         $difference=$request->difference;
        DB::table('inventory_product')->where('inventory_id',$id)->delete();
         $insert_data=array();
         for($count=0;$count<count($exist);$count++){
             
             $insert_data['inventory_id']=$id;
             $insert_data['product_id']=$product[$count];
             $insert_data['exist']=$exist[$count];
             $insert_data['real']=$real[$count];
             $insert_data['difference']=$difference[$count];
                
             
            DB::table('inventory_product')->insert($insert_data);
  
         }
         
 
         return redirect()->route('admin.inventory.index')->with('success','Thành công');
    }

    
    public function destroy($id) {
        $inventory = $this->inventoryRepo->find($id);
        $this->inventoryRepo->delete($id);
        return redirect()->back()->with('success', 'Xóa thành công');
    }

}
