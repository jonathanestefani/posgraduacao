import { IPerson } from '../../person/IPerson';
import { IJobInfo } from './IJobInfo';

export interface IJob {
  id: number;
  name: string;
  status: number;
  person_id: number;
  person?: IPerson;
  job_info: Array<IJobInfo>;
  created_at?: Date;
  updated_at?: Date;
  deleted_at?: Date;
}
