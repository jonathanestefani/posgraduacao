<?php

namespace App\Services\ScheduleWeek;

use App\BaseRepository\Services\ListAllService as ServicesListAllService;

use App\Services\ScheduleWeek\Filters\TDefaultFilters;
use App\Services\ScheduleWeek\Aggregates\TDefaultAggregates;

class ListAllService extends ServicesListAllService
{
    use TDefaultFilters, TDefaultAggregates;
}
