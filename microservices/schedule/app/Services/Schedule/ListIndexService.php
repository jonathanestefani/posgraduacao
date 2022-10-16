<?php

namespace App\Services\Schedule;

use App\BaseRepository\Abs\ARepository;
use App\BaseRepository\Api\LoadApi;
use App\BaseRepository\TFilters;
use App\BaseRepository\Filters\ListFilter;
use App\BaseRepository\THttpRequest;
use App\BaseRepository\TAggregate;
use App\BaseRepository\TIndex;
use App\Exceptions\ErrorServiceException;
use App\Services\IServices\IService;
use Illuminate\Support\Facades\Log;

class ListIndexService extends ARepository implements IService
{
    use THttpRequest, TFilters, TAggregate, TIndex;

    public function __construct($model)
    {
        $this->with = [
            'api' => new LoadApi('jobs', 'job_id', 'job'),
        ];

        parent::__construct($model);
    }

    private function defineFilters()
    {
        $this->filters = [
            "job_id" => new ListFilter(FilterNumber::class, "job_id"),
            "job" => new ListFilter(FilterJob::class, "date"),
            "date" => new ListFilter(FilterDate::class, "date")
        ];
    }

    public function execute()
    {
        try {
            $this->defineFilters();
            return $this->Index();
        } catch (\Throwable $th) {
            Log::error($th);

            throw new ErrorServiceException($th->getMessage());
        }
    }
}
