<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\MemberRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    public function __construct(MemberRepository $memberRepo) {
        $this->memberRepo = $memberRepo;
    }

    public function index()
    {
        $records = $this->memberRepo->all();
        return view('backend/member/index', compact('records'));
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
