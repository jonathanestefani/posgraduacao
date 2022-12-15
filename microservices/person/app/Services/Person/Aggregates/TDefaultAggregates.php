<?php

namespace App\Services\Person\Aggregates;

trait TDefaultAggregates
{
    protected function defineAggregate()
    {
        $this->with = [];
    }
}
