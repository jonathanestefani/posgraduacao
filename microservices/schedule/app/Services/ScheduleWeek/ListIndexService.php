<?php

namespace App\Services\ScheduleWeek;

use App\BaseRepository\Services\ListIndexService as ServicesListIndexService;

use App\Services\ScheduleWeek\Filters\TDefaultFilters;
use App\Services\ScheduleWeek\Aggregates\TDefaultAggregates;

class ListIndexService extends ServicesListIndexService
{
    use TDefaultFilters, TDefaultAggregates;
}
