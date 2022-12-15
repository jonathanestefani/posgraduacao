<?php

namespace App\Services\ScheduleWeek;

use App\BaseRepository\Services\IServices\IService;
use App\BaseRepository\Services\StoreService;
use App\Models\ScheduleTime;
use App\Models\ScheduleWeek;
use App\Services\ScheduleWeek\ListAllService as WeekListAllService;
use App\Services\ScheduleTime\ListAllService as TimeListAllService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PrepareWeekService implements IService
{
    protected Array $request = [];

    public function execute()
    {
        $week = [];

        $this->removeDeletedWeek();

        foreach($this->request as $tmp_week) {
            $tmp_times = $tmp_week['times'];

            unset($tmp_week['times']);            

            $week_record = (new StoreService(ScheduleWeek::class))->importRequest($tmp_week)->execute();

            if ($week_record) {
                $this->removeDeletedSchedules($week_record, $tmp_times);

                $week_record['times'] = [];
                $week_record['times'] = $this->storeTimes($tmp_times, $week_record);

                array_push($week, $week_record);
            }
        }

        return $week;
    }

    private function removeDeletedWeek() {
        $request = [
            "filters" => [
                "job_id" => $this->request[0]["job_id"]
            ]
        ];

        $listAllWeek = (new WeekListAllService(ScheduleWeek::class))->importRequest($request)->execute();

        foreach ($listAllWeek as $scheduleWeek) {
            try {
                if (array_search($scheduleWeek->id, array_column($this->request, 'id')) === false) {
                    $scheduleWeek->delete();
    
                    $listTimes = $this->getTimesByJob($scheduleWeek->id);
    
                    foreach ($listTimes as $scheduleTime) {
                        $scheduleTime->delete();
                    }    
                }
            } catch (\Throwable $th) {
                Log::info("===removeDeletedWeek===");

                Log::info($th);
                //throw $th;
            }
        }
    }

    private function getTimesByJob($job_id, $shedule_week_id = 0) {
        $request = [
            "filters" => [
                "job_id" => $job_id
            ]
        ];

        if (!is_null($shedule_week_id) && $shedule_week_id > 0) {
            $request["filters"]["schedule_week_id"] = $shedule_week_id;
        }
    
        return (new TimeListAllService(ScheduleTime::class))->importRequest($request)->execute();
    }

    private function removeDeletedSchedules($tmp_week, $tmp_times) {
        $listAllTimes = $this->getTimesByJob($tmp_week["job_id"], $tmp_week["id"]);

        foreach ($listAllTimes as $scheduleTime) {
            try {
                if (array_search($scheduleTime->id, array_column($tmp_times, 'id')) === false) {
                    $scheduleTime->delete();
                }
            } catch (\Throwable $th) {
                Log::info("===removeDeletedSchedules===");

                Log::info($th);
                //throw $th;
            }
            
        }
    }

    private function storeTimes(&$tmp_times, &$week_record) {
        $times = [];

        foreach ($tmp_times as $tmp_time) {
            $tmp_time['time'] = strtotime($tmp_time['time']);
            $tmp_time['schedule_week_id'] = $week_record->id;
            $tmp_time['job_id'] = $week_record->job_id;

            $time = (new StoreService(ScheduleTime::class))->importRequest($tmp_time)->execute();

            array_push($times, $time);
        }

        return $times;
    }

    public function setRequest(Request &$request)
    {
        $this->request = $request->all();

        return $this;
    }

}
