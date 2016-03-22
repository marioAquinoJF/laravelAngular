<?php

namespace larang\Validators;

use Prettus\Validator\LaravelValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
/**
 * Description of ProjectFileValidator
 *
 * @author Mario
 */
class ProjectFileValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'file' => 'required|mimes:jpg,jpeg,bmp,png',
            'name' => 'required|max:255',
            'description' => 'required',
            'project_id' => 'required|integer|exists:projects,id'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => 'required|max:255',
            'description' => 'required',
            'project_id' => 'required|integer|exists:projects,id'
        ]
    ];

}
