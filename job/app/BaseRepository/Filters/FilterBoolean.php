<?php

namespace App\BaseRepository\Filters;

use App\BaseRepository\Abs\AbsFilter;
use Illuminate\Database\Eloquent\Builder;

class FilterBoolean extends AbsFilter
{
    public function execute($key, $value): Builder
    {
        return $this->builder->where($key, $value);
    }
}
