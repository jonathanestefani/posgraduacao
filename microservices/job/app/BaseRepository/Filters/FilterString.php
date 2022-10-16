<?php

namespace App\BaseRepository\Filters;

use App\BaseRepository\Abs\AbsFilter;
use Illuminate\Database\Eloquent\Builder;

class FilterString extends AbsFilter
{
    public function execute(String $key, $value): Builder
    {
        if (gettype($value) === 'array') {
            return $this->builder->whereIn($key, $value);
        }

        return $this->builder->where($key, "{$value}");
    }
}
