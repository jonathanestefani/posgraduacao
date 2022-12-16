<?php

namespace App\Services\User;

use App\BaseRepository\Services\ListIndexService as ServicesListIndexService;
use App\Services\User\Filters\TDefaultFilters;

class ListIndexService extends ServicesListIndexService
{
    use TDefaultFilters;
}
