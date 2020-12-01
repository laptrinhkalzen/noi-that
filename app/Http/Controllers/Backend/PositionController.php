<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\PositionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PositionController extends Controller
{
    public function __construct(PositionRepository $positionRepo) {
        $this->positionRepo = $positionRepo;
    }

    public function index()
    {
        $records = $this->positionRepo->all();
        return view('backend/position/index', compact('records'));
    }
 public function create() {
        //
        return view('backend/position/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $input = $request->all();
        $validator = \Validator::make($input, $this->positionRepo->validateCreate());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $position = $this->positionRepo->create($input);
        if ($position->id) {
            return redirect()->route('admin.position.index')->with('success', 'Tạo mới thành công');
        } else {
            return redirect()->route('admin.position.index')->with('error', 'Tạo mới thất bại');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $record = $this->positionRepo->find($id);
        return view('backend/position/edit', compact('record'));
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
        $validator = \Validator::make($input, $this->positionRepo->validateUpdate($id));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $res = $this->positionRepo->update($input, $id);
        if ($res) {
            return redirect()->route('admin.position.index')->with('success', 'Cập nhật thành công');
        } else {
            return redirect()->route('admin.position.index')->with('error', 'Cập nhật thất bại');
        }
    }
    public function show($id)
    {
        $record = $this->positionRepo->find($id);
        return view('backend/position/detail', compact('record'));
    }

    public function destroy($id)
    {
        $this->positionRepo->delete($id);
        return redirect()->back()->with('success','Xóa thành công');
    }
}
