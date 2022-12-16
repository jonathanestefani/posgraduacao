<?php

namespace App\Services\UserType;

use App\BaseRepository\Services\ListAllService;
use App\Services\UserType\Filters\TDefaultFilters;

class ListIndexService extends ListAllService
{
    use TDefaultFilters;
}
