<?php

namespace App\Services\Attendance\Filters;

use App\BaseRepository\Filters\FilterNumber;
use App\BaseRepository\Filters\ListFilter;

trait TDefaultFilters
{
    protected function defineFilters()
    {
        $this->filters = [
            "person_id" => new ListFilter(FilterNumber::class, "person_id"),
            "job_id" => new ListFilter(FilterNumber::class, "job_id"),
            "scheduke_week_id" => new ListFilter(FilterNumber::class, "scheduke_week_id"),
            "scheduke_time_id" => new ListFilter(FilterNumber::class, "scheduke_time_id"),
            "status_id" => new ListFilter(FilterNumber::class, "status_id"),
            'requests_by_person_id' => new ListFilter(RequestsByJobId::class, 'job_id'),
            "search" => new ListFilter(Search::class, "obs"),
        ];
    }
}
