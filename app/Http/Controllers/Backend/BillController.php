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
    public function create() {
        return view('backend/bill/create');
    }

    
     

     //nhap kho
     
    public function index(){
        $records=DB::table('bill')->get();
        return view('backend/bill/index',compact('records'));
    }

    public function bill_create() {
        $products=DB::table('product')->get();
        $stocks=DB::table('stock')->get();
        $suppliers=DB::table('supplier')->get();
        // $members=DB::table('member')->orderBy('created_at', 'desc')->get();
        return view('backend/stock/import_create',compact('products','suppliers','stocks'));
    }

     public function bill_edit($id) {
        $products=DB::table('product')->get();
        $stocks=DB::table('stock')->get();
        $suppliers=DB::table('supplier')->get();
        $import=DB::table('import')->where('import_id',$id)->first();
        $import_products=DB::table('import_product')->where('import_id',$id)->get();
        // $members=DB::table('member')->orderBy('created_at', 'desc')->get();
        return view('backend/stock/import_edit',compact('products','suppliers','stocks','import','import_products'));
    }
}