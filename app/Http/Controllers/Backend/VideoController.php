<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Repositories\VideoRepository;
use Repositories\CategoryRepository;
use App\Helpers\StringHelper;

class VideoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(VideoRepository $videoRepo, CategoryRepository $categoryRepo) {
        $this->videoRepo = $videoRepo;
        $this->categoryRepo = $categoryRepo;
    }

    public function index() {
        $records = $this->videoRepo->all();
        return view('backend/video/index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $options = $this->categoryRepo->readCategoryByType(\App\Category::TYPE_VIDEO);
        $category_html = StringHelper::getSelectOptions($options);
        return view('backend/video/create', compact('category_html'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $input = $request->all();
        $validator = \Validator::make($input, $this->videoRepo->validateCreate());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
//      status
        if (isset($input['status'])) {
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }
        if (isset($input['is_hot'])) {
            $input['is_hot'] = 1;
        } else {
            $input['is_hot'] = 0;
        }
        $input['created_by'] = \Auth::user()->id;
        $input['view_count'] = 0;
        if (isset($input['post_schedule'])) {
            $input['post_schedule'] = $input['post_schedule_submit'];
        }

        $video = $this->videoRepo->create($input);
        $video->categories()->attach($input['category_id']);
        return redirect()->route('admin.video.index')->with('success', 'Tạo mới thành công');
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
        $record = $this->videoRepo->find($id);
        $options = $this->categoryRepo->readCategoryByType(\App\Category::TYPE_VIDEO);
        $category_ids = $record->categories()->get()->pluck('id')->toArray();
        $category_html = StringHelper::getSelectOptions($options, $category_ids);
        return view('backend/video/edit', compact('record', 'category_html'));
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
        $validator = \Validator::make($input, $this->videoRepo->validateUpdate($id));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
//      status
        if (isset($input['status'])) {
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }
        if (isset($input['is_hot'])) {
            $input['is_hot'] = 1;
        } else {
            $input['is_hot'] = 0;
        }
        $input['created_by'] = \Auth::user()->id;
        if (isset($input['post_schedule'])) {
            $input['post_schedule'] = $input['post_schedule_submit'];
        }

        $res = $this->videoRepo->update($input, $id);
        if ($res == true) {
            $video = $this->videoRepo->find($id);
            $video->categories()->sync($input['category_id']);
            return redirect()->route('admin.video.index')->with('success', 'Cập nhật thành công');
        } else {
            return redirect()->route('admin.video.index')->with('error', 'Cập nhật thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $video = $this->videoRepo->find($id);
        $video->categories()->detach();
        $this->videoRepo->delete($id);
        return redirect()->route('admin.video.index')->with('success', 'Xóa thành công');
    }

}
