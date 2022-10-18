<?php

namespace App\Services\Cities;

use App\BaseRepository\Abs\ARepository;
use App\BaseRepository\Crud\TCrud;
use App\BaseRepository\THttpRequest;
use App\BaseRepository\Exceptions\ErrorBaseRepositoryException;
use App\Exceptions\ErrorServiceException;
use App\Services\IServices\IService;
use Illuminate\Support\Facades\Log;
use Throwable;

class DestroyService extends ARepository implements IService
{
    use THttpRequest, TCrud;

    public function execute()
    {
        try {
            $this->destroy();
        } catch (ErrorBaseRepositoryException $th) {
            Log::error($th);
        
            throw new ErrorServiceException($th->getMessage());
        } catch (Throwable $th) {
            Log::error($th);

            throw $th;
        }
    }
}
