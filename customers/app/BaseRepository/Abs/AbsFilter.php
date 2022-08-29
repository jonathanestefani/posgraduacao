<?php

namespace App\BaseRepository\Abs;

use Illuminate\Database\Eloquent\Builder;

abstract class AbsFilter
{
    private $builder;

    public function __construct(Builder $builder)
    {
        $this->builder = $builder;
    }

    abstract public function execute(String $key, $value): Builder;
}
