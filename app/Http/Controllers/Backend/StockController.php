<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Repositories\StockRepository;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use TIMESTAMP;
use DB;


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
        // $members=DB::table('member')->orderBy('created_at', 'desc')->get();
        return view('backend/stock/create');
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $stock = $this->stockRepo->find($id);
        $this->stockRepo->delete($id);
        return redirect()->back()->with('success', 'Xóa thành công');
    }

}
