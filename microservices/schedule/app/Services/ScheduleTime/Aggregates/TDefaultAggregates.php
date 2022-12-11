<?php

namespace App\Services\ScheduleTime\Aggregates;

use App\BaseRepository\Api\LoadApi;

trait TDefaultAggregates
{
    protected function defineAggregate()
    {
        $this->with = [
            'api' => new LoadApi('jobs', 'job_id', 'job'),
        ];
    }
}
