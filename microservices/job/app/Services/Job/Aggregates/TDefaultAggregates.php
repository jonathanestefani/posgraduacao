<?php

namespace App\Services\Job\Aggregates;

use App\BaseRepository\Api\LoadApi;

trait TDefaultAggregates
{
    protected function defineAggregate()
    {
        $this->with = [
            'job_info',
            'api' => new LoadApi('persons', 'person_id')
        ];
    }
}
