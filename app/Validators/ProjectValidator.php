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
class ProjectValidator  extends LaravelValidator{

    protected $rules = [
        'owner_id' => 'required|integer|exists:users,id',
        'client_id' => 'required|integer|exists:clients,id',
        'name' => 'required:max:255',
        'progress' => 'required',
        'status' => 'required',
        'due_date' => 'required|date'
    ];

}
