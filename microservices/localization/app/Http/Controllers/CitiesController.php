<?php

namespace App\Http\Controllers;

use App\BaseRepository\Filters\ListFilter;
use App\BaseRepository\Services\DestroyService;
use App\BaseRepository\Services\ListAllService;
use App\BaseRepository\Services\ListIndexService;
use App\BaseRepository\Services\LoadService;
use App\BaseRepository\Services\StoreService;
use App\Models\Cities;
use App\Exceptions\ErrorServiceException;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CitiesController extends Controller
{

    public function index(Request $request)
    {
        try {
            $data = [];

            if ($request->all == true) {
                $data = (new ListAllService(Cities::class))
                ->setRequest($request)
                ->setFilters([
                    "name" => new ListFilter(FilterStringLike::class, "name")
                ])
                ->execute();
            } else {
                $data = (new ListIndexService(Cities::class))
                ->setRequest($request)
                ->setFilters([
                    "name" => new ListFilter(FilterStringLike::class, "name")
                ])
                ->execute();
            }

            return response()->json($data);
        } catch (ErrorServiceException $th) {
            return new Response(["message" => $th->getMessage()], 400);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return new Response(["message" => "Ocorreu um erro ao carregar os dados dos cidades!"], 500);
        }
    }

    public function show($id)
    {
        try {
            $params = new Request([
                "id" => $id
            ]);

            $data = (new LoadService(Cities::class))
            ->setRequest($params)
            ->setFilters([
                "name" => new ListFilter(FilterStringLike::class, "name")
            ])
            ->execute();
            return new Response($data);
        } catch (ErrorServiceException $th) {
            return new Response(["message" => $th->getMessage()], 400);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return new Response(['message' => 'Ocorreu um erro ao carregar os dados do cidade!'], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $data = (new StoreService(Cities::class))
            ->setRequest($request)
            ->execute();

            return response()->json($data);
        } catch (ErrorServiceException $th) {
            return new Response(["message" => $th->getMessage()], 400);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return new Response(['message' => 'Ocorreu um erro ao tentar atualizar cidade!'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = (new StoreService(Cities::class))->setRequest($request)->execute();

            return response()->json($data);
        } catch (ErrorServiceException $th) {
            return new Response(["message" => $th->getMessage()], 400);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return new Response(['message' => 'Ocorreu um erro ao tentar cadastrar o cidade!'], 500);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $data = (new DestroyService(Cities::class))->setRequest($request)->execute();

            return response()->json($data);
        } catch (ErrorServiceException $th) {
            return new Response(["message" => $th->getMessage()], 400);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return new Response(['message' => 'Ocorreu um erro ao tentar excluir o cidade!'], 500);
        }
    }
}
