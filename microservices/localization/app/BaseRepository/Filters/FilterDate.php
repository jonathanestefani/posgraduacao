<?php

namespace App\BaseRepository\Filters;

use App\BaseRepository\Abs\AbsFilter;
use Illuminate\Database\Eloquent\Builder;

class FilterDate extends AbsFilter
{
    public function execute(String $key, $value): Builder
    {
        if (isset($value["start"]) && isset($value["final"])) {
            return $this->builder->whereBetween($key, [$value["start"], $value["final"]]);
        } else {
            return $this->builder->whereRaw('date(' . $key . ') = ?', $value);
        }
    }
}
