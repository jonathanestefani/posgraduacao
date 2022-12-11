<?php

namespace App\Services\ScheduleTime;

use App\BaseRepository\Services\LoadService as ServiceLoadService;
use App\Services\ScheduleTime\Aggregates\TDefaultAggregates;
use App\Services\ScheduleTime\Filters\TDefaultFilters;

class LoadService extends ServiceLoadService
{
    use TDefaultFilters, TDefaultAggregates;
}
