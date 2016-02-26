<?php

namespace larang\Validators;

use Prettus\Validator\LaravelValidator;

/**
 * Description of ProjectValidator
 *
 * @author Mario
 */
class ProjectTaskValidator extends LaravelValidator
{

    protected $rules = [
        'name' => 'required:max:255',
        'status' => 'required',
        'start_date' => 'required|date',
        'due_date' => 'required|date'
    ];

}
