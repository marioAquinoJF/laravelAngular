<?php

namespace larang\Services;

use Prettus\Validator\Exceptions\ValidatorException;
use larang\Repositories\ProjectFileRepository;
use larang\Validators\ProjectFileValidator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Filesystem\Filesystem;

class ProjectFileService extends Service
{

    private $fileSystem;
    private $storage;
    protected $repository;
    protected $validator;

    public function __construct(ProjectFileRepository $repository, ProjectFileValidator $validator, Filesystem $fileSystem, Storage $storage)
    {
        $this->fileSystem = $fileSystem;
        $this->storage = $storage;
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function create(array $data)
    {
        try {
            $this->validator->with($data)->passesOrFail();

            $file = $data['file'];
            $extension = $file->getClientOriginalExtension();
            $data['file'] = $file;
            $data['extension'] = $extension;
            $data['lable'] = $data['lable'] ? $data['lable'] : null;
            $data['description'] = $data['description'] ? $data['description'] : null;
            if ($this->repository->create($data)) {
                if (Storage::put(trim($data['name']) . '.' . $data['extension'], File::get($data['file']))) {
                    return true;
                }
            }
        } catch (ValidatorException $ex) {
            return [
                'error' => TRUE,
                'message' => $ex->getMessageBag()
            ];
        }
    }

    public function deleteFile($id)
    {
        $pf = $this->repository->skipPresenter()->find($id);
        $filename = $pf->name . "." . $pf->extension;
        if (Storage::exists($filename)) {
            Storage::delete($filename);
        }
        if (!Storage::exists($filename)) {
            return $pf->delete();
        }
        return false;
    }

}
