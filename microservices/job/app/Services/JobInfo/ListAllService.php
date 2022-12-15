<?php

namespace App\Services\JobInfo;

use App\BaseRepository\Services\ListAllService as ServicesListAllService;
use App\Services\JobInfo\Filters\TDefaultFilters;

class ListAllService extends ServicesListAllService
{
    use TDefaultFilters;
}
