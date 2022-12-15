<?php

namespace App\Services\JobInfo;

use App\BaseRepository\Services\ListAllService;
use App\Services\JobInfo\Filters\TDefaultFilters;

class ListIndexService extends ListAllService
{
    use TDefaultFilters;
}
