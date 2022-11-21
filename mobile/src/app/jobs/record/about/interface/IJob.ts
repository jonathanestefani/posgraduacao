import { IJobInfo } from './IJobInfo';

export interface IJob {
  id: number;
  name: string;
  status: number;
  person_id: number;
  job_info: Array<IJobInfo>;
  created_at?: Date;
  updated_at?: Date;
  deleted_at?: Date;
}
