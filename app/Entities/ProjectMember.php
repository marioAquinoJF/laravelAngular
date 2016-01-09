<?php

namespace larang\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ProjectMember extends Model implements Transformable {

    use TransformableTrait;

    protected $table = 'projects_members';
    protected $fillable = ['user_id', 'project_id'];

    public function projects() {
        return $this->belongsToMany(Project::class, 'projects_members', 'user_id', 'project_id');
    }

}
