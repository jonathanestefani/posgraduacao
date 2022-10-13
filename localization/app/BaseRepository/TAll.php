<?php

namespace App\BaseRepository;

use App\BaseRepository\Enum\ETypeCall;

trait TAll 
{
    public function All()
    {
        if (method_exists($this, 'defineAggregate')) {
            $this->defineAggregate();
        }

        $this->beforeExecute(ETypeCall::ALL);

        if (method_exists($this, 'executeFilters')) {
            $this->executeFilters();
        }

        if (method_exists($this, 'executeOrder')) {
            $this->applyOrder();
        }

        $this->data = $this->instance->get();

        $this->afterExecute(ETypeCall::ALL);

        return $this->data;
    }
}
