<?php

namespace App\Services\ScheduleWeek;

use App\BaseRepository\Abs\ARepository;
use App\Services\IServices\IService;

use App\BaseRepository\Crud\TLoad;
use App\BaseRepository\THttpRequest;

use App\Exceptions\ErrorServiceException;
use Illuminate\Support\Facades\Log;

class LoadService extends ARepository implements IService
{
    use THttpRequest, TLoad;

    public function execute() {
        try {
            return $this->data;
        } catch (\Throwable $th) {
            Log::error($th);
        
            throw new ErrorServiceException($th->getMessage());
        }
    }
}
