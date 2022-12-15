<?php

namespace App\Services\Job;

use App\BaseRepository\Services\ListAllService as ServicesListAllService;
use App\Services\Job\Aggregates\TDefaultAggregates;
use App\Services\Job\Filters\TDefaultFilters;

class ListAllService extends ServicesListAllService
{
    use TDefaultAggregates, TDefaultFilters;
}
