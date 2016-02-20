<?php

namespace larang\Presenters;

use Prettus\Repository\Presenter\FractalPresenter;
use larang\Transformers\ProjectFileTransformer;

class ProjectFilePresenter extends FractalPresenter
{

    public function getTransformer()
    {
        return new ProjectFileTransformer();
    }

}
