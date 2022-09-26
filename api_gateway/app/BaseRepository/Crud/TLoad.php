<?php

namespace App\BaseRepository\Crud;

use App\Exceptions\ErrorServiceBaseRepositoryException;

trait TLoad {

    public function load($id)
    {
        try {
            $this->modelClassInstance = $this->modelClass::find($id);

            if (empty($this->modelClassInstance)) {
                throw new ErrorServiceBaseRepositoryException("Não foi possível encontrar os dados na base de dados!");
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}