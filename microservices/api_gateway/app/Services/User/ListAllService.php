<?php

namespace App\Services\User;

use App\BaseRepository\Services\ListAllService as ServicesListAllService;
use App\Services\User\Filters\TDefaultFilters;

class ListAllService extends ServicesListAllService
{
    use TDefaultFilters;
}
