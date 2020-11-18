<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Repositories\NewsRepository;
use Repositories\CategoryRepository;
use Repositories\PostHistoryRepository;

class NewsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(NewsRepository $newsRepo, CategoryRepository $categoryRepo, PostHistoryRepository $postHistoryRepo) {
        $this->newsRepo = $newsRepo;
        $this->categoryRepo = $categoryRepo;
        $this->postHistoryRepo = $postHistoryRepo;
    }

    public function index() {
        
        if (\Auth::user()->role_id == \App\User::ROLE_ADMINISTRATOR || \Auth::user()->role_id == \App\User::ROLE_EDITOR) {
            $records = $this->newsRepo->all();
        } else {
            $records = $this->newsRepo->getAllByUserId(\Auth::user()->id);
        }
        return view('backend/news/index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $options = $this->categoryRepo->readCategoryByType(\App\Category::TYPE_NEWS);
        $category_html = \App\Helpers\StringHelper::getSelectOptions($options);
        return view('backend/news/create', compact('category_html'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $input = $request->all();
        $validator = \Validator::make($input, $this->newsRepo->validateCreate());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
//      status
        if (isset($input['status']) && \Auth::user()->role_id <> \App\User::ROLE_CONTRIBUTOR) {
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }
        $input['is_hot'] = isset($input['is_hot']) ? 1 : 0;
        $input['created_by'] = \Auth::user()->id;
        $input['view_count'] = 0;
        if (isset($input['post_schedule'])) {
            $input['post_schedule'] = $input['post_schedule_submit'];
        }

        $news = $this->newsRepo->create($input);
        $news->categories()->attach($input['category_id']);
        if ($news) {
            return redirect()->route('admin.news.index')->with('success', 'Tạo mới thành công');
        } else {
            return redirect()->route('admin.news.index')->with('error', 'Tạo mới thất bại');
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
        $record = $this->newsRepo->find($id);
        $category_ids = $record->categories()->get()->pluck('id')->toArray();
        $options = $this->categoryRepo->readCategoryByType(\App\Category::TYPE_NEWS);
        $category_html = \App\Helpers\StringHelper::getSelectOptions($options, $category_ids);
        return view('backend/news/edit', compact('record', 'category_html'));
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
        $validator = \Validator::make($input, $this->newsRepo->validateUpdate($id));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
//      status
        $input['status'] = (isset($input['status']) && \Auth::user()->role_id <> \App\User::ROLE_CONTRIBUTOR) ? 1 : 0;
        $input['is_hot'] = isset($input['is_hot']) ? 1 : 0;
        if (isset($input['post_schedule'])) {
            $input['post_schedule'] = $input['post_schedule_submit'];
        }

        $res = $this->newsRepo->update($input, $id);
        if ($res == true) {
            $news = $this->newsRepo->find($id);
            $news->categories()->sync($input['category_id']);
            return redirect()->route('admin.news.index')->with('success', 'Cập nhật thành công');
        } else {
            return redirect()->route('admin.news.index')->with('error', 'Cập nhật thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $news = $this->newsRepo->find($id);
        $news->categories()->detach();
        $this->newsRepo->delete($id);
        return redirect()->route('admin.news.index')->with('success', 'Xóa thành công');
        //
    }

}
