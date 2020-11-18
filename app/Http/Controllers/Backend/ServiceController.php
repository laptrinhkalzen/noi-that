<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\ServiceRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public function __construct(ServiceRepository $serviceRepo) {
        $this->serviceRepo = $serviceRepo;
    }

    public function index()
    {
        $records = $this->serviceRepo->all();
        return view('backend/service/index', compact('records'));
    }

    public function create()
    {
        return view('backend/service/create');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = \Validator::make($input, $this->serviceRepo->validateCreate());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
//      status
        if (isset($input['status'])) {
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }
        $this->serviceRepo->create($input);
        return redirect()->route('admin.service.index')->with('success', 'Thêm thành công');
    }

    public function edit($id)
    {
        $record = $this->serviceRepo->find($id);
        return view('backend/service/update', compact('record'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $validator = \Validator::make($input, $this->serviceRepo->validateUpdate($id));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
//      status
        if (isset($input['status'])) {
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }
        $this->serviceRepo->update($input,$id);
        return redirect()->route('admin.service.index')->with('success', 'Cập nhật thành công');
    }

    public function destroy($id)
    {
        $this->serviceRepo->delete($id);
        return redirect()->back()->with('success','Xóa thành công');
    }
}
