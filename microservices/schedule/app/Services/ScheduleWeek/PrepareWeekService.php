<?php

namespace App\Services\ScheduleWeek;

use App\BaseRepository\Services\IServices\IService;
use App\BaseRepository\Services\StoreService;
use App\Models\ScheduleTime;
use App\Models\ScheduleWeek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PrepareWeekService implements IService
{
    protected Array $request = [];

    public function execute()
    {
        $week = [];

        foreach($this->request as $tmp_week) {
            $tmp_times = $tmp_week['times'];

            unset($tmp_week['times']);

            $week_record = (new StoreService(ScheduleWeek::class))->importRequest($tmp_week)->execute();

            if ($week_record) {
                $week_record['times'] = [];

                $times = [];

                foreach ($tmp_times as $tmp_time) {
                    $tmp_time['time'] = strtotime($tmp_time['time']);
                    $tmp_time['schedule_week_id'] = $week_record->id;
                    $tmp_time['job_id'] = $week_record->job_id;

                    $time = (new StoreService(ScheduleTime::class))->importRequest($tmp_time)->execute();

                    array_push($times, $time);
                }

                $week_record['times'] = $times;

                array_push($week, $week_record);
            }
        }

        return $week;
    }

    public function setRequest(Request &$request)
    {
        $this->request = $request->all();

        return $this;
    }

}
