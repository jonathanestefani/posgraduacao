<?php

namespace App\BaseRepository;

use App\BaseRepository\Enum\ETypeCall;

trait TAll 
{
    public function All()
    {
        $this->instanceModel = $this->modelClass::query();
        $this->defineAggregate();

        $this->beforeExecute(ETypeCall::ALL);

        /*
        if (!array_key_exists("filter", $this->httpRequest)) {
            $ordered = $this->applyOrder($this->instanceModel);

            $this->data = $ordered->get();

            $this->afterExecute(ETypeCall::ALL);

            return $this->data;
        }
        */

        if (method_exists($this, 'executeFilters')) {
            $this->executeFilters();
        }

        if (method_exists($this, 'executeOrder')) {
            $this->applyOrder();
        }

        $this->data = $this->instanceModel->get();

        $this->afterExecute(ETypeCall::ALL);

        return $this->data;
    }
}
