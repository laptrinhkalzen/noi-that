<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Repositories\ProjectRepository;
use Repositories\GalleryRepository;

class ProjectController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(ProjectRepository $projectRepo,GalleryRepository $galleryRepo) {
        $this->projectRepo = $projectRepo;
        $this->galleryRepo = $galleryRepo;
    }

    public function index() {
        $records = $this->projectRepo->all();
        return view('backend/project/index', compact('records'));
    }

    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
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
        $record = $this->projectRepo->find($id);
        foreach($record->gallery as $gallery){
            $images[]=$gallery->images;
        }
        $record->images=implode('|',$images);
        return view('backend/project/update', compact('record'));
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
        if(($request->get('status'))){
           $input['status']=1; 
        }else{
           $input['status']=0;  
        };
        if(($request->get('is_hot'))){
           $input['is_hot']=1; 
        }else{
           $input['is_hot']=0;  
        };
        $images = explode('|', $input['images']);
        $this->galleryRepo->deleteByProject($id);
        foreach ($images as $k => $val) {
            $gallery['images'] = $val;
            $gallery['title'] = $input['title'];
            $gallery['status'] = $input['status'];
            $gallery['view_count'] = 0;
            $gallery['ordering'] = 0;
            $gallery['post_schedule'] = date('Y-m-d H:i:s');
            $gallery['alias'] = \App\Helpers\StringHelper::getAlias($input['title'] . "-" . $k++);
            $gallerys = $this->galleryRepo->create($gallery);
            $ids[] = $gallerys->id;
        }
        $input['alias'] = \App\Helpers\StringHelper::getAlias($input['title']);
        $res = $project = $this->projectRepo->update($input,$id);
        $galery['project_id'] = $id;
        foreach ($ids as $val) {
            $this->galleryRepo->update($galery,$val);
        }
        if ($res) {
            return redirect()->route('admin.project.index')->with('success', 'Cập nhật thành công');
        } else {
            return redirect()->route('admin.project.index')->with('error', 'Cập nhật thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $project=$this->projectRepo->find($id);
        foreach($project->gallery as $val){
            $gallery = $this->galleryRepo->find($val->id);
            $gallery->categories()->detach();
            $gallery->attributes()->detach();
            $this->galleryRepo->delete($val->id);
        }
        $this->projectRepo->delete($project->id);
        return redirect()->back()->with('success', 'Xóa thành công');
    }

}
