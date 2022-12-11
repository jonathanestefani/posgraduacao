<?php

namespace App\Services\ScheduleTime;

use App\BaseRepository\Services\ListIndexService as ServicesListIndexService;
use App\Services\ScheduleTime\Aggregates\TDefaultAggregates;
use App\Services\ScheduleTime\Filters\TDefaultFilters;

class ListIndexService extends ServicesListIndexService
{
    use TDefaultFilters, TDefaultAggregates;
}
