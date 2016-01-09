<?php

namespace larang\Presenters;

use Prettus\Repository\Presenter\FractalPresenter;
use larang\Transformers\ProjectTransformer;

class ProjectPresenter extends FractalPresenter
{

    public function getTransformer()
    {
        return new ProjectTransformer();
    }

}
