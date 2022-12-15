<?php

namespace App\Services\Person;

use App\BaseRepository\Services\ListIndexService as ServicesListIndexService;
use App\Services\Person\Aggregates\TDefaultAggregates;
use App\Services\Person\Filters\TDefaultFilters;

class ListIndexService extends ServicesListIndexService
{
    use TDefaultAggregates, TDefaultFilters;
}
