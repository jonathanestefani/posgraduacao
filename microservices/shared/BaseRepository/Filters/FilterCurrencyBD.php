<?php

namespace App\BaseRepository\Filters;

use App\BaseRepository\Abs\AbsFilter;
use Illuminate\Database\Eloquent\Builder;

class FilterCurrencyBD extends AbsFilter
{
    public function execute(string $key, $value): Builder
    {
        if (gettype($value) === 'array') {
            return $this->builder->whereIn($key, $value);
        }

        return $this->builder->where($key, number_format($value, 2, '.', ''));
    }
}
