<?php

namespace App\Services\Countries;

use App\BaseRepository\Abs\ARepository;
use App\BaseRepository\TFilters;
use App\BaseRepository\Filters\FilterStringLike;
use App\BaseRepository\Filters\ListFilter;
use App\BaseRepository\THttpRequest;
use App\BaseRepository\TAggregate;
use App\BaseRepository\TIndex;
use App\Exceptions\ErrorServiceBaseRepositoryException;
use App\Exceptions\ErrorServiceException;
use App\Services\IServices\IService;
use Illuminate\Support\Facades\Log;
use Throwable;

class ListIndexService extends ARepository implements IService
{
    use THttpRequest, TFilters, TAggregate, TIndex;

    private function defineFilters()
    {
        $this->filters = [
            "name" => new ListFilter(FilterStringLike::class, "name")
        ];
    }

    public function execute()
    {
        try {
            $this->defineFilters();
            return $this->Index();
        } catch (ErrorServiceBaseRepositoryException $th) {
            Log::error($th);
        
            throw new ErrorServiceException($th->getMessage());
        } catch (Throwable $th) {
            Log::error($th);

            throw $th;
        }
    }
}
