<?php

namespace App\Http\Controllers;

use App\BaseRepository\Services\DestroyService;
use App\BaseRepository\Services\LoadService;
use App\BaseRepository\Services\StoreService;
use App\Models\ScheduleTime;
use App\Exceptions\ErrorServiceException;
use App\Services\ScheduleTime\ListAllService;
use App\Services\ScheduleTime\ListIndexService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;

class ScheduleTimeController extends Controller
{

    public function index(Request $request)
    {
        try {
            $data = [];

            if ($request->all == true) {
                $data = (new ListAllService(ScheduleTime::class))->setRequest($request)->execute();
            } else {
                $data = (new ListIndexService(ScheduleTime::class))->setRequest($request)->execute();
            }

            return response()->json($data);
        } catch (ErrorServiceException $th) {
            return new Response(["message" => $th->getMessage()], 400);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return new Response(["message" => "Ocorreu um erro ao carregar os dados!"], 500);
        }
    }

    public function show($id)
    {
        try {
            $params = new Request([
                "id" => $id
            ]);

            Log::info($params);

            $data = (new LoadService(ScheduleTime::class))->setRequest($params)->execute();
            return new Response($data);
        } catch (ErrorServiceException $th) {
            return new Response(["message" => $th->getMessage()], 400);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return new Response(['message' => 'Ocorreu um erro ao carregar os dados!'], 500);
        }
    }

    public function update($id, Request $request)
    {
        try {
            $data = (new StoreService(ScheduleTime::class))->setRequest($request)->execute();

            return response()->json($data);
        } catch (ErrorServiceException $th) {
            return new Response(["message" => $th->getMessage()], 400);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return new Response(['message' => 'Ocorreu um erro ao tentar atualizar!'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            Log::info($request);

            $this->request['time'] = strtotime($this->request['time']);

            $data = (new StoreService(ScheduleTime::class))->setRequest($request)->execute();

            return response()->json($data);
        } catch (ErrorServiceException $th) {
            return new Response(["message" => $th->getMessage()], 400);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return new Response(['message' => 'Ocorreu um erro ao tentar cadastrar!'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $request = new Request(['id' => $id]);

            (new DestroyService(ScheduleTime::class))->setRequest($request)->execute();

            return response()->json([]);
        } catch (ErrorServiceException $th) {
            return new Response(["message" => $th->getMessage()], 400);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return new Response(['message' => 'Ocorreu um erro ao tentar excluir!'], 500);
        }
    }
}
