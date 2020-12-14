<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\MessageBag;
use Validator;


class TransportController extends Controller
{
    public function create()
    {
        
        $cities = DB::table('city')->get();
        return view('backend/transport/create')->with('cities',$cities);      
    }

    public function index(){
        $transports = DB::table('transport')->get();
        $cities= DB::table('city')->get();
        
        return view('backend/transport/index')->with('transports', $transports)->with('cities',$cities);

    }

    public function store(Request $request){
        
     
        $data = array();
        $data['name']= $request->name;
        
        
              $this->validate($request,
        [
             'name' => 'bail|required',          
            
             
                
        ],

        [
            'required' => ':attribute không được để trống',
            'unique' => ':attribute đã tồn tại',
        ],

        [
            'name' => 'Tên đơn vị vận chuyển',
            
      ]

    );

        $transport = DB::table('transport')->insert($data);
        if ($transport) {
            return redirect()->route('admin.transport.index')->with('success', 'Tạo mới thành công');
        } else {
            return redirect()->route('admin.transport.index')->with('error', 'Tạo mới thất bại');
        }
        }
    
     public function detail($id){
        

    

    }
    public function edit($id){
        
         $transport = DB::table('transport')->where('id',$id)->first();
         return view('backend/transport/edit',compact('transport'));
    }
    public function update(Request $request, $id){
        
        $data = array();
        $data['name']= $request->name;
        
        
        $transport = DB::table('transport')->where('id', $id)->update($data);
        if ($transport) {
            return redirect()->route('admin.transport.index')->with('success', 'Cập nhật thành công');
        } else {
            return redirect()->route('admin.transport.index')->with('error', 'Cập nhật thất bại');
        }
    }
    public function destroy($id){
        
        DB::table('transport')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Xóa thành công');
    }
}
