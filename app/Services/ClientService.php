<?php

namespace larang\Services;

use larang\Repositories\ClientRepository;
use larang\Validators\ClientValidator;

/**
 * Description of ClientService
 *
 * @author Mario
 */
class ClientService extends Service
{

    protected $repository;
    protected $validator;

    public function __construct(ClientRepository $repository, ClientValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

}
