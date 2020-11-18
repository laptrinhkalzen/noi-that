<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Repositories\ReviewRepository;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(ReviewRepository $reviewRepo) {
        $this->reviewRepo = $reviewRepo;
    }
    public function index()
    {
        $records = $this->reviewRepo->all();
        return view('backend/review/index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->reviewRepo->delete($id);
        return redirect()->back()->with('success', 'Xóa thành công');
    }
}
