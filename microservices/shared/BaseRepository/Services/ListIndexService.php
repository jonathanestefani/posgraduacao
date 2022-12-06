<?php

namespace App\BaseRepository\Services;

use App\BaseRepository\Abs\ARepository;
use App\BaseRepository\Services\IServices\IService;
use App\BaseRepository\TFilters;
use App\BaseRepository\THttpRequest;
use App\BaseRepository\TAggregate;
use App\BaseRepository\TIndex;

use App\Services\ScheduleWeek\Filters\TDefaultFilters;
use App\Services\ScheduleWeek\Aggregates\TDefaultAggregates;

use App\Exceptions\ErrorServiceException;

use Illuminate\Support\Facades\Log;

class ListIndexService extends ARepository implements IService
{
    use THttpRequest, TFilters, TAggregate, TIndex, TDefaultFilters, TDefaultAggregates;

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
