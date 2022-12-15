<?php

namespace App\Services\Job;

use App\BaseRepository\Services\ListIndexService as ServicesListIndexService;
use App\Services\Job\Aggregates\TDefaultAggregates;
use App\Services\Job\Filters\TDefaultFilters;

class ListIndexService extends ServicesListIndexService
{
    use TDefaultAggregates, TDefaultFilters;
}
