<?php

namespace larang\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ProjectFile extends Model implements Transformable
{

    use TransformableTrait;

    protected $table = 'project_files';
    protected $fillable = [
        'name',
        'lable',
        'description',
        'extension',
        'project_id'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
}
