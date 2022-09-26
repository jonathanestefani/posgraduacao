<?php

namespace App\BaseRepository;

use Closure;

trait TAggregate
{
    protected $with = [];

    public function defineAggregate()
    {
        if (count($this->with) > 0) {
            foreach ($this->with as $tableRelationModel => $scope) {
                if (gettype($scope) == "object") {
                    $this->modelClassInstance->with([$tableRelationModel => $scope])->whereHas($tableRelationModel, $scope);
                } else {
                    $this->modelClassInstance->with($scope);
                }
            }
        }
    }

    public function setWhereHas($table, Closure $scope)
    {
        $key = array_search($table, $this->with);

        if ($key >= 0) {
            unset($this->with[$key]);
        }

        $this->with[$table] = $scope;
        return $this;
    }
}
