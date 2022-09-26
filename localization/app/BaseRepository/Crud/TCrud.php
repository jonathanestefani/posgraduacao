<?php

namespace App\BaseRepository\Crud;

use App\Exceptions\ErrorServiceBaseRepositoryException;

trait TCrud {
    use TCreate, TUpdate, TLoad, TDestroy;

    private function crudValidation()
    {
        if (!isset($this->request)) {
            throw new ErrorServiceBaseRepositoryException("Parâmetros não definidos");
        }
    }
}