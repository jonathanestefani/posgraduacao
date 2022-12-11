<?php

namespace App\Services\ScheduleTime\Filters;

use App\BaseRepository\Filters\FilterNumber;
use App\BaseRepository\Filters\ListFilter;

trait TDefaultFilters
{
    protected function defineFilters()
    {
        $this->filters = [
            "job_id" => new ListFilter(FilterNumber::class, "job_id"),
            "schedule_week_id" => new ListFilter(FilterNumber::class, "schedule_week_id"),
            "time" => new ListFilter(FilterNumber::class, "time"),
        ];
    }
}
