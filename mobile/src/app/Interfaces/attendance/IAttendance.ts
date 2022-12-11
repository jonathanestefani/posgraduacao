import { IJob } from "../job/interface/IJob";
import { IPerson } from "../person/IPerson";
import { IScheduleTime } from "../schedule/IScheduleTime";
import { IScheduleWeek } from "../schedule/IScheduleWeek";

export interface IAttendance {
  id?: number;
  person_id?: number;
  person?: IPerson;
  job_id?: number;
  job?: IJob;
  schedule_week_id?: number;
  week?: Array<IScheduleWeek>;
  schedule_time_id?: number;
  time?: Array<IScheduleTime>;
  status?: number;
  obs?: string;
}
