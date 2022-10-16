<?php

namespace App\Services\Job;

use App\BaseRepository\Abs\ARepository;
use App\BaseRepository\Api\LoadApi;
use App\BaseRepository\TAll;
use App\BaseRepository\TFilters;
use App\BaseRepository\Filters\FilterStringLike;
use App\BaseRepository\Filters\ListFilter;
use App\BaseRepository\THttpRequest;
use App\BaseRepository\TAggregate;
use App\Exceptions\ErrorServiceException;
use App\Services\IServices\IService;
use Illuminate\Support\Facades\Log;

class ListAllService extends ARepository implements IService
{
    use THttpRequest, TFilters, TAggregate, TAll;

    public function __construct($model)
    {
        $this->with = [
            'info',
            'api' => new LoadApi('persons', 'person_id')
        ];

        parent::__construct($model);
    }

    private function defineFilters()
    {
        $this->filters = [
            "name" => new ListFilter(FilterStringLike::class, "name")
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
