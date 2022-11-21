<?php

namespace App\Services\Job;

use App\BaseRepository\Abs\ARepository;
use App\BaseRepository\Api\LoadApi;
use App\BaseRepository\TFilters;
use App\BaseRepository\Filters\FilterStringLike;
use App\BaseRepository\Filters\ListFilter;
use App\BaseRepository\THttpRequest;
use App\BaseRepository\TAggregate;
use App\BaseRepository\TIndex;
use App\Exceptions\ErrorServiceException;
use App\Services\IServices\IService;
use App\Services\Job\filters\filterSearch;
use Illuminate\Support\Facades\Log;

class ListIndexService extends ARepository implements IService
{
    use THttpRequest, TFilters, TAggregate, TIndex;

    public function __construct($model)
    {
        $this->with = [
            'job_info',
            'api' => new LoadApi('persons', 'person_id', 'person')
        ];

        parent::__construct($model);
    }

    private function defineFilters()
    {
        $this->filters = [
            "search" => new ListFilter(filterSearch::class, "name"),
            "name" => new ListFilter(FilterStringLike::class, "name")
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
