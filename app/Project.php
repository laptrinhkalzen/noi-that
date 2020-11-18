<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

    //
    protected $table = "project";
    protected $fillable = [
        'title', 'alias', 'construction_id', 'description', 'content','status','is_hot'
    ];

    public function url() {
        return route('project.detail', ['alias' => $this->alias]);
    }

    public function gallery() {
        $data = $this->hasMany('\App\Gallery', 'project_id', 'id');
        return $data;
    }

}
