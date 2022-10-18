<?php

namespace App\Services\Cities;

use App\BaseRepository\Abs\ARepository;
use App\BaseRepository\Crud\TCrud;
use App\BaseRepository\TAggregate;
use App\BaseRepository\THttpRequest;
use App\BaseRepository\Exceptions\ErrorBaseRepositoryException;
use App\Exceptions\ErrorServiceException;
use App\Services\IServices\IService;
use Illuminate\Support\Facades\Log;
use Throwable;

class LoadService extends ARepository implements IService
{
    use THttpRequest, TCrud, TAggregate;

    public function execute() {
        try {
            return $this->data;
        } catch (ErrorBaseRepositoryException $th) {
            Log::error($th);
        
            throw new ErrorServiceException($th->getMessage());
        } catch (Throwable $th) {
            Log::error($th);

            throw $th;
        }
    }
}
