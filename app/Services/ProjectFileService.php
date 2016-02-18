<?php

namespace larang\Services;

use larang\Repositories\ProjectFileRepository;
use larang\Validators\ProjectFileValidator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Filesystem\Filesystem;

class ProjectFileService extends Service
{

    private $fileSystem;
    private $storage;

    public function __construct(ProjectFileRepository $repository, ProjectFileValidator $validator, Filesystem $fileSystem, Storage $storage)
    {
        parent::__construct($repository, $validator);
        $this->fileSystem = $fileSystem;
        $this->storage = $storage;
    }

    public function createFile(array $data)
    {
        $file = parent::create($data);

        if ($file) {
            if (Storage::put($data['name'] . '.' . $data['extension'], File::get($data['file']))) {
                return $file;
            }
        }
    }

    public function deleteFile($id)
    {
        $pf = $this->repository->find($id);
        //($this->repository->find($id));
        $filename = $pf->name . "." . $pf->extension;
        if (Storage::exists($filename)) {
            Storage::delete($filename);
        }
        if (!Storage::exists($filename)) {
            return $pf->delete($id);
        }
        return false;
    }

}
