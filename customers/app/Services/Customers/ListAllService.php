<?php

namespace App\Services\Customers;

use App\BaseRepository\Abs\ARepository;
use App\BaseRepository\TAll;
use App\BaseRepository\TFilters;
use App\BaseRepository\Filters\FilterStringLike;
use App\BaseRepository\Filters\ListFilter;
use App\BaseRepository\THttpRequest;
use App\BaseRepository\TAggregate;
use App\Services\IServices\IService;

class ListAllService extends ARepository implements IService
{
    use THttpRequest, TFilters, TAggregate, TAll;

    private function defineFilters()
    {
        $this->filters = [
            "name" => new ListFilter(FilterStringLike::class, "name")
        ];
    }

    public function execute()
    {
        $this->defineFilters();

        return $this->All();
    }
}
