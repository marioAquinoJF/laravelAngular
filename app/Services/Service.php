<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace larang\Services;

use Prettus\Validator\Exceptions\ValidatorException;

class Service
{

    public function __construct()
    {
        
    }

    public function create(array $data)
    {
        try {
            $this->validator->with($data)->passesOrFail();

            return $this->repository->create($data);
        } catch (ValidatorException $ex) {
            return [
                'error' => TRUE,
                'message' => $ex->getMessageBag()
            ];
        }
    }

    public function update(array $data, $id)
    {
        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->update($data, $id);
        } catch (ValidatorException $ex) {
            return [
                'error' => TRUE,
                'message' => $ex->getMessageBag()
            ];
        }
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }

}
