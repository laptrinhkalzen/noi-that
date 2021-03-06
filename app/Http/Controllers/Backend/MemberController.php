<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\MemberRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\GroupRepository;
use DB;
//use Repositories\GroupRepository;

class MemberController extends Controller
{
    public function __construct(MemberRepository $memberRepo ,GroupRepository $groupRepo) {
        $this->memberRepo = $memberRepo;
        $this->groupRepo = $groupRepo;
    }

    public function index()
    {
        $records = $this->memberRepo->all();
        return view('backend/member/index', compact('records'));
    }
 public function create() {
        //
        $options = DB::table('group')->get();
        $group_html = \App\Helpers\StringHelper::getSelectRoleOptions($options);
        return view('backend/member/create',compact('group_html','options'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $input = $request->all();
        $validator = \Validator::make($input, $this->memberRepo->validateCreate());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $member = $this->memberRepo->create($input);
        if ($member->id) {
            return redirect()->route('admin.member.index')->with('success', 'Tạo mới thành công');
        } else {
            return redirect()->route('admin.member.index')->with('error', 'Tạo mới thất bại');
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
        $record = $this->memberRepo->find($id);
        $options = DB::table('group')->get();
        return view('backend/member/edit', compact('record','options'));
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
        $validator = \Validator::make($input, $this->memberRepo->validateUpdate($id));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $res = $this->memberRepo->update($input, $id);
        if ($res) {
            return redirect()->route('admin.member.index')->with('success', 'Cập nhật thành công');
        } else {
            return redirect()->route('admin.member.index')->with('error', 'Cập nhật thất bại');
        }
    }
    public function show($id)
    {
        $record = $this->memberRepo->find($id);
        return view('backend/member/detail', compact('record'));
    }

    public function destroy($id)
    {
        $this->memberRepo->delete($id);
        return redirect()->back()->with('success','Xóa thành công');
    }
}
