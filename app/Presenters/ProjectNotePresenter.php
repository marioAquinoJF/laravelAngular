<?php

namespace larang\Presenters;

use Prettus\Repository\Presenter\FractalPresenter;
use larang\Transformers\ProjectNoteTransformer;

class ProjectNotePresenter extends FractalPresenter {

    public function getTransformer() {
        return new ProjectNoteTransformer();
    }

}
