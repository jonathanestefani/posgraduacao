import { IPerson } from '../../person/IPerson';
import { IUser } from '../../User/IUser';
import { IJobInfo } from './IJobInfo';

export interface IJob {
  id: number;
  name: string;
  status: number;
  user?: IUser;
  person_id: number;
  person?: IPerson;
  job_info: Array<IJobInfo>;
  created_at?: Date;
  updated_at?: Date;
  deleted_at?: Date;
}
