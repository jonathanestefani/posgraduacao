import { Injectable } from '@angular/core';
import { IJob } from 'src/app/Interfaces/job/interface/IJob';

@Injectable()
export class JobStore {
  private store: IJob;
  private jobId: number;

  constructor() {
    this.newModel();
  }

  public set(job: IJob) {
    this.store = { ... this.store, ...job };
  }

  public get(): IJob {
    return this.store;
  }

  public getJobId(): number {
    return this.jobId;
  }

  public setJobId(jobId: number) {
    this.jobId = jobId;
  }

  public newModel() {
    this.store = {
      id: 0,
      name: '',
      status: 1,
      person_id: 0,
      job_info: []
    };

    this.jobId = 0;
  }
}
