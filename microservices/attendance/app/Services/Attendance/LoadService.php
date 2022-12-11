<?php

namespace App\Services\Attendance;

use App\BaseRepository\Services\LoadService as ServicesLoadService;
use App\Services\Attendance\Aggregates\TDefaultAggregates;
use App\Services\Attendance\Filters\TDefaultFilters;

class LoadService extends ServicesLoadService
{
    use TDefaultAggregates, TDefaultFilters;
}
