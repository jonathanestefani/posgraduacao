<?php

namespace App\Services\ScheduleTime;

use App\BaseRepository\Services\ListAllService as ServicesListAllService;
use App\Services\ScheduleTime\Aggregates\TDefaultAggregates;
use App\Services\ScheduleTime\Filters\TDefaultFilters;

class ListAllService extends ServicesListAllService
{
    use TDefaultFilters, TDefaultAggregates;
}
