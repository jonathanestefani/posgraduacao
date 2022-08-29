<?php

namespace App\Services\Customers;

use App\BaseRepository\Abs\ARepository;
use App\BaseRepository\Crud\TCrud;
use App\BaseRepository\Enum\EOperation;
use App\BaseRepository\THttpRequest;
use App\Exceptions\ErrorServiceBaseRepositoryException;
use App\Services\IServices\IService;

class StoreService extends ARepository implements IService
{
    use THttpRequest, TCrud;

    public function execute()
    {
        switch ($this->operation) {
            case EOperation::CREATE:
                $this->create();
                break;
            case EOperation::UPDATE:
                $this->update();
                break;
        }

        throw new ErrorServiceBaseRepositoryException("Não foi possível definir o tipo de operação!");
    }
}
