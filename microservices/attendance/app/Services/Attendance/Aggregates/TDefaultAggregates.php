<?php

namespace App\Services\Attendance\Aggregates;

use App\BaseRepository\Api\LoadApi;

trait TDefaultAggregates
{
    protected function defineAggregate()
    {
        $this->with = [
            'job' => new LoadApi('jobs', 'job_id', 'job'),
            'person' => new LoadApi('persons', 'person_id', 'person'),
            'week' => new LoadApi('schedules', 'schedule_week_id', 'week', 'week'),
            'time' => new LoadApi('schedules', 'schedule_time_id', 'times', 'time'),
        ];
    }
}
