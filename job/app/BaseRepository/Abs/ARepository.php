<?php

namespace App\BaseRepository\Abs;

use App\Exceptions\ErrorApiCallException;
use App\Exceptions\ErrorServiceException;
use App\Services\Utils\UtilsService;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

abstract class ARepository
{
    protected $modelClass;
    protected $instance;
    protected $data;

    public function __construct($model)
    {
        $this->setModel($model);

        return $this;
    }

    public function setModel($model) {
        $this->modelClass = $model;
        $this->instance = $model::query();
    }

    // ENUM EMethodTypeAtCall
    protected function beforeExecute(String $method_type_at_call) {}
    protected function afterExecute(String $method_type_at_call) {}
}
