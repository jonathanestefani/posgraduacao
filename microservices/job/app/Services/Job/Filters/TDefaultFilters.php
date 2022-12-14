<?php

namespace App\Services\Job\Filters;

use App\BaseRepository\Filters\FilterNumber;
use App\BaseRepository\Filters\FilterStringLike;
use App\BaseRepository\Filters\ListFilter;
use App\Services\Job\Filters\FilterSearch;

trait TDefaultFilters
{
    protected function defineFilters()
    {
        $this->filters = [
            "person_id" => new ListFilter(FilterNumber::class, "person_id"),
            "person_name" => new ListFilter(FilterSearch::class, "name"),
            "name" => new ListFilter(FilterStringLike::class, "name")
        ];
    }
}
