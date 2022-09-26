<?php

namespace App\Services\States;

use App\BaseRepository\Abs\ARepository;
use App\BaseRepository\Crud\TCrud;
use App\BaseRepository\Enum\EOperation;
use App\BaseRepository\THttpRequest;
use App\Exceptions\ErrorServiceBaseRepositoryException;
use App\Exceptions\ErrorServiceException;
use App\Services\IServices\IService;
use Illuminate\Support\Facades\Log;
use Throwable;

class StoreService extends ARepository implements IService
{
    use THttpRequest, TCrud;

    public function execute()
    {
        try {
            switch ($this->operation) {
                case EOperation::CREATE:
                    return $this->create();
                    break;
                case EOperation::UPDATE:
                    return $this->update();
                    break;
            }
        } catch (ErrorServiceBaseRepositoryException $th) {
            Log::error($th);

            throw new ErrorServiceException($th->getMessage());
        } catch (Throwable $th) {
            Log::error($th);

            throw $th;
        }

        throw new ErrorServiceException("Não foi possível definir o tipo de operação!");
    }
}
