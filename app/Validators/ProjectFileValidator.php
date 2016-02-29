<?php

namespace larang\Validators;

use Prettus\Validator\LaravelValidator;

/**
 * Description of ProjectFileValidator
 *
 * @author Mario
 */
class ProjectFileValidator extends LaravelValidator
{

    protected $rules = [

        'file' => 'required|mimes:jpg,jpeg,bmp,png,txt',
        'name' => 'required|max:255',
        'description' => 'required',
        'lable' => '',
        'project_id' => 'required|integer|exists:projects,id'
    ];

}
