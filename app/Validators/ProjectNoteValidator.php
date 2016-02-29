<?php

namespace larang\Validators;

use Prettus\Validator\LaravelValidator;

class ProjectNoteValidator extends LaravelValidator
{

    protected $rules = [
        //  'project_id' => 'required|integer|exists:projects,id',
        'title' => 'required:max:255',
        'note' => 'required',
    ];

}
