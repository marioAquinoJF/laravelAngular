<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace larang\Validators;

use Prettus\Validator\LaravelValidator;

/**
 * Description of ClientValidator
 *
 * @author Mario
 */
class UserValidator extends LaravelValidator {

    protected $rules = [
        'name' => 'required|max:255',
        'email' => 'required|email',
    ];

}
