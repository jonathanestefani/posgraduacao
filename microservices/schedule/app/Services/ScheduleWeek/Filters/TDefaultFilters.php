<?php

namespace App\Services\ScheduleWeek\Filters;

use App\BaseRepository\Filters\FilterNumber;
use App\BaseRepository\Filters\ListFilter;

trait TDefaultFilters
{
    protected function defineFilters()
    {
        $this->filters = [
            "job_id" => new ListFilter(FilterNumber::class, "job_id"),
            "job" => new ListFilter(FilterJob::class, "date")
        ];
    }
}
