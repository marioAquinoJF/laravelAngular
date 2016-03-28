<?php

namespace larang\Validators;

use Prettus\Validator\LaravelValidator;

class ProjectMemberValidator extends LaravelValidator
{

    protected $rules = [
        'project_id' => 'required',
        'member_id' => 'required'
    ];

}
