<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace larang\Presenters;

use larang\Transformers\UserTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Description of UserPresenter
 *
 * @author Mario
 */
class UserPresenter extends FractalPresenter
{

    public function getTransformer()
    {
        return new UserTransformer();
    }

}
