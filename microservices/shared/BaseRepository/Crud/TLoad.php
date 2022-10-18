<?php

namespace App\BaseRepository\Crud;

use App\Exceptions\ErrorServiceBaseRepositoryException;

trait TLoad {

    public function load($id)
    {
        try {
            if (method_exists($this, 'defineAggregate')) {
                $this->defineAggregate();
            }

            $this->data = $this->instance->find($id);

            if (empty($this->instance)) {
                throw new ErrorServiceBaseRepositoryException("Não foi possível encontrar os dados na base de dados!");
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}