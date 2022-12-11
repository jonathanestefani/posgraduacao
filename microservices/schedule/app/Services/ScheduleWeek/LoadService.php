<?php

namespace App\Services\ScheduleWeek;

use App\BaseRepository\Services\LoadService as ServiceLoadService;

use App\Services\ScheduleWeek\Filters\TDefaultFilters;
use App\Services\ScheduleWeek\Aggregates\TDefaultAggregates;

class LoadService extends ServiceLoadService
{
    use TDefaultFilters, TDefaultAggregates;
}
