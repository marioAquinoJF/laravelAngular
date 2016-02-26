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
        'project_id' => 'required|int|exists:projects,id',
        'file' => 'required|mimes:jpg,jpeg,bmp,png,txt',
        'name' => 'required|max:255',
        'extension' => ['required', 'regex:/((jpg)|(jpeg)|(bmp)|(png)|(txt))/'],
        'description' => '',
        'lable' => ''
    ];

}
