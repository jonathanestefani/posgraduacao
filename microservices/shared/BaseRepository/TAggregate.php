<?php

namespace App\BaseRepository;

use App\BaseRepository\Abs\ARepository;
use Closure;
use App\BaseRepository\Api\LoadApi;
use App\BaseRepository\Exceptions\ErrorApiCallException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

trait TAggregate
{
    protected $with = [];

    public function setWith(array $with)
    {
        $this->with = $with;
    }

    public function executeAggregate()
    {
        /*
        if (method_exists($this, 'defineAggregate')) {
            $this->defineAggregate();
        }
        */

        if (count($this->with) > 0) {
            foreach ($this->with as $tableRelationModel => $scope) {
                if ($scope instanceof LoadApi) continue;

                if (gettype($scope) == "object") {
                    $this->instance->with([$tableRelationModel => $scope])->whereHas($tableRelationModel, $scope);
                } else {
                    $this->instance->with($scope);
                }
            }
        }
    }

    public function loadRelationsByApi()
    {
        if (count($this->with) == 0) return;

        if (is_array($this->data)) {
            foreach ($this->data as $row) {
                $this->processWith($row);
            }
        } else if ($this->data instanceof ARepository || $this->data instanceof Model) {
            $this->processWith($this->data);
        }
    }

    private function processWith (&$row) {
        foreach ($this->with as $tableRelationModel => $scope) {
            if (!$scope instanceof LoadApi) continue;

            try {
                $value = $row[$scope->getKeyLocal()];

                $result = $scope->setValue($value)->loadRelation();

                $row[$scope->getAlias()] = $result;
            } catch (ErrorApiCallException $th) {
                Log::info($th);
                $row[$scope->getAlias()] = null;
            } catch (\Throwable $th) {
                //throw $th;
                Log::info($th);

                $row[$scope->getAlias()] = null;
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
