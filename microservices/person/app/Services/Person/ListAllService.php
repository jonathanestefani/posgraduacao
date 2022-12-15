<?php

namespace App\Services\Person;

use App\BaseRepository\Services\ListAllService as ServicesListAllService;
use App\Services\Person\Aggregates\TDefaultAggregates;
use App\Services\Person\Filters\TDefaultFilters;

class ListAllService extends ServicesListAllService
{
    use TDefaultAggregates, TDefaultFilters;
}
