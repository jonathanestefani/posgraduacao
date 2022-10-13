<?php

namespace App\Services\Schedule;

use App\BaseRepository\Abs\ARepository;
use App\BaseRepository\Crud\TLoad;
use App\BaseRepository\TAggregate;
use App\BaseRepository\THttpRequest;
use App\Exceptions\ErrorServiceException;
use App\Services\IServices\IService;
use Illuminate\Support\Facades\Log;

class LoadService extends ARepository implements IService
{
    use THttpRequest, TLoad, TAggregate;

    public function __construct($model)
    {
        parent::__construct($model);

        return $this;
    }

    public function execute() {
        try {
            return $this->data;
        } catch (\Throwable $th) {
            Log::error($th);
        
            throw new ErrorServiceException($th->getMessage());
        }
    }
}
