<?php

namespace App\Services\Attendance;

use App\BaseRepository\Services\ListAllService as ServicesListAllService;
use App\Services\Attendance\Aggregates\TDefaultAggregates;
use App\Services\Attendance\Filters\TDefaultFilters;
use App\Services\Attendance\Ordenations\TDefaultOrdenations;

class ListAllService extends ServicesListAllService
{
    use TDefaultAggregates, TDefaultFilters, TDefaultOrdenations;
}
