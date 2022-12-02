import { IScheduleTime } from "./IScheduleTime";

export interface IScheduleWeek {
  id: number;
  job_id?: number;
  day_week?: string;
  times?: Array<IScheduleTime>;
}
