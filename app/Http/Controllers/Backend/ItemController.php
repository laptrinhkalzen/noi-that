<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Repositories\ItemRepository;
use Repositories\CategoryRepository;

class ItemController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(ItemRepository $itemRepo, CategoryRepository $categoryRepo) {
        $this->itemRepo = $itemRepo;
        $this->categoryRepo = $categoryRepo;
    }

    public function index() {
        $records = $this->itemRepo->all();
        return view('backend/item/index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $category_html = \App\Helpers\StringHelper::getSelectOptions($this->categoryRepo->all()->where('type', \App\Category::TYPE_CONSTRUCTION));
        return view('backend/item/create', compact('category_html'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $input = $request->all();
        $validator = \Validator::make($input, $this->itemRepo->validateCreate());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($input['category_id'] == null) {
            $input['category_id'] = 0;
        }
        if (isset($input['status'])) {
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }
        $item = $this->itemRepo->create($input);
        if ($item->id) {
            return redirect()->route('admin.item.index')->with('success', 'Tạo mới thành công');
        } else {
            return redirect()->route('admin.item.index')->with('error', 'Tạo mới thất bại');
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
        //
        $record = $this->itemRepo->find($id);
        $category_html = \App\Helpers\StringHelper::getSelectOptions($this->categoryRepo->all()->where('type', \App\Category::TYPE_CONSTRUCTION), $record->category_id);
        return view('backend/item/edit', compact('record', 'category_html'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
        $input = $request->all();
        $validator = \Validator::make($input, $this->itemRepo->validateUpdate($id));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($input['category_id'] == null) {
            $input['category_id'] = 0;
        }
        if (isset($input['status'])) {
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }
        $res = $this->itemRepo->update($input, $id);
        if ($res) {
            return redirect()->route('admin.item.index')->with('success', 'Cập nhật thành công');
        } else {
            return redirect()->route('admin.item.index')->with('error', 'Cập nhật thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $res = $this->itemRepo->delete($id);
        if ($res) {
            return redirect()->back()->with('success', 'Xóa thành công');
        } else {
            return redirect()->back()->with('error', 'Xóa thất bại');
        }
    }

}
