<?php

namespace App\Http\Controllers;

use App\BaseRepository\Services\DestroyService;
use App\Models\Job;
use App\Models\JobInfo;
use App\Services\Job\ListAllService;
use App\Services\Job\ListIndexService;
use App\Services\Job\LoadService;
use App\Exceptions\ErrorServiceException;
use App\Services\Job\StoreService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;

class JobController extends Controller
{

    public function index(Request $request)
    {
        try {
            $data = [];

            if ($request->all == true) {
                $data = (new ListAllService(Job::class))->setRequest($request)->execute();
            } else {
                $data = (new ListIndexService(Job::class))->setRequest($request)->execute();
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

            $data = (new LoadService(Job::class))->setRequest($params)->execute();
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
            $jobs = [];
            foreach ($request->job_info as $value) {
                $form = $value;
                $form['job_id'] = $id;

                $form = new Request($form);

                $jobs[] = (new StoreService(JobInfo::class))->setRequest($form)->execute();
            }

            $data = (new StoreService(Job::class))->setRequest($request)->execute();

            $data = (new LoadService(Job::class))->setRequest($request)->execute();

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
            $job_info = $request->job_info;

            $data = (new StoreService(Job::class))->setRequest($request)->execute();

            $jobs = [];
            foreach ($job_info as $value) {
                $form = $value;
                $form['job_id'] = $data->id;

                $form = new Request($form);

                $jobs[] = (new StoreService(JobInfo::class))->setRequest($form)->execute();
            }

            $data['jobs'] = $jobs;

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

            (new DestroyService(Job::class))->setRequest($request)->execute();

            return response()->json([]);
        } catch (ErrorServiceException $th) {
            return new Response(["message" => $th->getMessage()], 400);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return new Response(['message' => 'Ocorreu um erro ao tentar excluir!'], 500);
        }
    }
}
