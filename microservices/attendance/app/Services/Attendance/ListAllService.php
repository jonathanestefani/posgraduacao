<?php

namespace App\Services\Attendance;

use App\BaseRepository\Abs\ARepository;
use App\BaseRepository\Filters\FilterDate;
use App\BaseRepository\TAll;
use App\BaseRepository\TFilters;
use App\BaseRepository\Filters\ListFilter;
use App\BaseRepository\THttpRequest;
use App\BaseRepository\TAggregate;
use App\Exceptions\ErrorServiceException;
use App\Services\IServices\IService;
use App\Services\Schedule\Filters\FilterJob;
use Illuminate\Support\Facades\Log;

class ListAllService extends ARepository implements IService
{
    use THttpRequest, TFilters, TAggregate, TAll;

    public function __construct()
    {
        $this->with = ['job'];
    }

    private function defineFilters()
    {
        $this->filters = [
            "job" => new ListFilter(FilterJob::class, "date"),
            "date" => new ListFilter(FilterDate::class, "date")
        ];
    }

    public function execute()
    {
        try {
            $this->defineFilters();

            return $this->All();
        } catch (\Throwable $th) {
            Log::error($th);

            throw new ErrorServiceException($th->getMessage());
        }
    }
}
