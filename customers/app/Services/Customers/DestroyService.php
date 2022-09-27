<?php

namespace App\Services\Customers;

use App\BaseRepository\Abs\ARepository;
use App\BaseRepository\Crud\TDestroy;
use App\BaseRepository\THttpRequest;
use App\Exceptions\ErrorServiceException;
use App\Services\IServices\IService;
use Illuminate\Support\Facades\Log;

class DestroyService extends ARepository implements IService
{
    use THttpRequest, TDestroy;

    public function execute()
    {
        try {
            $this->destroy();
        } catch (\Throwable $th) {
            Log::error($th);

            throw new ErrorServiceException($th->getMessage());
        }
    }
}
