<?php

namespace App\Services\UserType;

use App\BaseRepository\Services\ListAllService as ServicesListAllService;
use App\Services\UserType\Filters\TDefaultFilters;

class ListAllService extends ServicesListAllService
{
    use TDefaultFilters;
}
