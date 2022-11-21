<?php

namespace App\Services\ScheduleWeek;

use App\BaseRepository\Abs\ARepository;
use App\BaseRepository\Crud\TCrud;
use App\BaseRepository\Enum\EOperation;
use App\BaseRepository\THttpRequest;
use App\Exceptions\ErrorServiceException;
use App\Services\IServices\IService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StoreService extends ARepository implements IService
{
    use THttpRequest, TCrud;

    public function execute()
    {
        try {
            // $this->validScheduleDateTime();

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

    // in progress
    private function validScheduleDateTime() {
        if (!isset($this->request['job_id'])) {
            return true;
        }

        $form = new Request([
            "job" => "",
            "date" => "",
        ]);

        $data = (new ListAllService(Schedule::class))->setRequest($form)->execute();
    }

}
