<?php

namespace App\BaseRepository;

use Closure;
use Illuminate\Support\Facades\Log;

trait TAggregate
{
    protected $with = [];

    public function defineAggregate()
    {
        if (count($this->with) > 0) {
            foreach ($this->with as $tableRelationModel => $scope) {
                if ($tableRelationModel == "api") continue;

                if (gettype($scope) == "object") {
                    $this->instance->with([$tableRelationModel => $scope])->whereHas($tableRelationModel, $scope);
                } else {
                    $this->instance->with($scope);
                }
            }
        }
    }

    public function loadRelationsByApi() {
        foreach($this->data as $row) {
            if (count($this->with) > 0) {
                foreach ($this->with as $tableRelationModel => $scope) {
                    if ($tableRelationModel != "api") continue;

                    $value = $row[ $scope->getKeyLocal() ];

                    try {
                        $result = $scope->setValue($value)->loadRelation();

                        $row[ $scope->getAlias() ] = $result;
                    } catch (\Throwable $th) {
                        //throw $th;
                        $row[ $scope->getApi() ] = null;
                    }
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
