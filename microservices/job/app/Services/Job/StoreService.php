<?php

namespace App\Services\Job;

use App\BaseRepository\Enum\EOperation;
use App\BaseRepository\Services\StoreService as ServicesStoreService;
use App\Exceptions\ErrorServiceException;
use Illuminate\Support\Facades\Log;

class StoreService extends ServicesStoreService
{
    public function execute()
    {
        unset($this->request['job_info']);

        try {
            switch ($this->operation) {
                case EOperation::CREATE:
                    return $this->create();
                    break;
                case EOperation::UPDATE:
                    return $this->update();
                    break;
            }
        } catch (\Throwable $th) {
            Log::error($th);

            throw new ErrorServiceException($th->getMessage());
        }

        throw new ErrorServiceException("Não foi possível definir o tipo de operação!");
    }

}
