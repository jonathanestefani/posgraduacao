<?php

namespace App\Services\Attendance;

use App\BaseRepository\Services\ListIndexService as ServicesListIndexService;
use App\Services\Attendance\Aggregates\TDefaultAggregates;
use App\Services\Attendance\Filters\TDefaultFilters;

class ListIndexService extends ServicesListIndexService
{
    use TDefaultAggregates, TDefaultFilters;
}
