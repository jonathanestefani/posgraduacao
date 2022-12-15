<?php

namespace App\Services\Person;

use App\BaseRepository\Services\LoadService as ServicesLoadService;
use App\Services\Person\Aggregates\TDefaultAggregates;
use App\Services\Person\Filters\TDefaultFilters;

class LoadService extends ServicesLoadService
{
    use TDefaultAggregates, TDefaultFilters;
}
