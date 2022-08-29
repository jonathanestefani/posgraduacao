<?php

namespace App\Services\Customers;

use App\BaseRepository\Abs\ARepository;
use App\BaseRepository\Crud\TCrud;
use App\BaseRepository\THttpRequest;
use App\Services\IServices\IService;

class DestroyService extends ARepository implements IService
{
    use THttpRequest, TCrud;

    public function execute()
    {
        $this->destroy();
    }
}
