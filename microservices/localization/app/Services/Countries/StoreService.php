<?php

namespace App\Services\Countries;

use App\BaseRepository\Abs\ARepository;
use App\BaseRepository\Crud\TCrud;
use App\BaseRepository\Enum\EOperation;
use App\BaseRepository\THttpRequest;
use App\BaseRepository\Exceptions\ErrorBaseRepositoryException;
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
        } catch (ErrorBaseRepositoryException $th) {
            Log::error($th);
        
            throw new ErrorServiceException($th->getMessage());
        } catch (Throwable $th) {
            Log::error($th);

            throw $th;
        }

        throw new ErrorServiceException("Não foi possível definir o tipo de operação!");
    }
}
