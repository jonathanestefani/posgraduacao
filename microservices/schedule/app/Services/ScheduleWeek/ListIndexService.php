<?php

namespace App\Services\ScheduleWeek;

use App\BaseRepository\Abs\ARepository;
use App\BaseRepository\Api\LoadApi;
use App\BaseRepository\TFilters;
use App\BaseRepository\THttpRequest;
use App\BaseRepository\TAggregate;
use App\BaseRepository\TIndex;
use App\Services\ScheduleWeek\Filters\TDefaultFilters;
use App\Exceptions\ErrorServiceException;
use App\Services\IServices\IService;
use Illuminate\Support\Facades\Log;

class ListIndexService extends ARepository implements IService
{
    use THttpRequest, TFilters, TAggregate, TIndex, TDefaultFilters;

    public function __construct($model)
    {
        $this->with = [
            'api' => new LoadApi('jobs', 'job_id', 'job'),
        ];

        parent::__construct($model);
    }

    public function execute()
    {
        try {
            return $this->Index();
        } catch (\Throwable $th) {
            Log::error($th);

            throw new ErrorServiceException($th->getMessage());
        }
    }
}
