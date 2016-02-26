<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace larang\Validators;

use Prettus\Validator\LaravelValidator;

/**
 * Description of ProjectValidator
 *
 * @author Mario
 */
class ProjectNoteValidator  extends LaravelValidator{

    protected $rules = [
      //  'project_id' => 'required|integer|exists:projects,id',
        'title' => 'required:max:255',
        'note' => 'required',
    ];

}
