<?php

namespace App\BaseRepository\Crud;

use App\BaseRepository\Exceptions\ErrorBaseRepositoryException;

trait TLoad {

    public function load($id)
    {
        try {
            if (method_exists($this, 'defineAggregate')) {
                $this->defineAggregate();
            }

            $this->data = $this->instance->find($id);

            if (empty($this->instance)) {
                throw new ErrorBaseRepositoryException("Não foi possível encontrar os dados na base de dados!");
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}