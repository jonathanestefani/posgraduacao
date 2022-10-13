<?php

namespace App\BaseRepository\Filters;

use App\BaseRepository\Abs\AbsFilter;
use Illuminate\Database\Eloquent\Builder;

class FilterDateRange extends AbsFilter
{
    public function execute(String $key, $value): Builder
    {
        if (empty($value["start"]) || empty($value["final"])) {
            return $this->builder;
        }

        $startValue = $value["start"];
        $datetimeStartValue = "$startValue 00:00";

        $finalValue = $value["final"];
        $datetimeFinalValue = "$finalValue 23:59";

        return $this->builder->whereBetween($key, [$datetimeStartValue, $datetimeFinalValue]);
    }
}
