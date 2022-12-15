<?php

namespace App\Services\Job;

use App\BaseRepository\Services\LoadService as ServicesLoadService;
use App\Services\Job\Aggregates\TDefaultAggregates;

class LoadService extends ServicesLoadService
{
    use TDefaultAggregates;
}
