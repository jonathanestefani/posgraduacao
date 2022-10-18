<?php

namespace App\BaseRepository\Abs;

use Illuminate\Database\Eloquent\Builder;

abstract class AbsFilter
{
    protected $builder;
    protected $filters = [];

    public function __construct(Builder $builder)
    {
        $this->builder = $builder;
    }

    public function setFilters(&$filters) {
        $this->filters = $filters;

        return $this;
    }

    public function getFilters() {
        return $this->filters;
    }

    abstract public function execute(String $key, $value): Builder;
}
