<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Igame;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Exports\ImportExport;
use App\Exports\InventoryExport;
use Maatwebsite\Excel\Facades\Excel;
use Artisan;


class ExportController extends Controller
{
  public function import_export() 
    {
        Session::put('message','Xuất dữ liệu thành công');
        return Excel::download(new ImportExport, 'phieunhap.xlsx');
        
    }
    public function inventory_export() 
    {
        Session::put('message','Xuất dữ liệu thành công');
        return Excel::download(new InventoryExport, 'phieukiemkho.xlsx');
        
    }
    // public function import() 
    // {
    //   // $path = 'https://drive.google.com/file/d/13e34sBwMjsn8PtoxNzqaJl7Xm4ap18sX/view?usp=sharing';
    //   // $filename = basename($path);
    //   // Image::make($path)->save(public_path('images/' . $filename));
    //     $import = Excel::import(new SinhVienImport, request()->file('sinh_vien_file'));
    //     Session::put('message','Nhập dữ liệu thành công');
    //     return redirect::to('toan-bo-sv')->with('success', 'Success!!!');
    // }
    
}
