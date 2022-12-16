import { Injectable } from '@angular/core';
import { Subject } from 'rxjs';
import { IJob } from 'src/app/Interfaces/job/interface/IJob';
import { IPerson } from 'src/app/Interfaces/person/IPerson';
import { AbstractStore } from '../abstract/abstract.store';

@Injectable({
  providedIn: 'root',
})
export class JobStore extends AbstractStore {
  static job: IJob = {
    id: 0,
    name: '',
    status: 1,
    person_id: 0,
    job_info: [
      { type: 'desc', name: 'Descrição', text: '', value: 0 },
      { type: 'number', name: 'Valor', text: '', value: 0 },
    ],
    person: {} as IPerson
  };

  protected store: IJob;
  protected jobId: number;
  protected update: Subject<IJob> = new Subject<IJob>();

  public get(): IJob {
    return this.store;
  }

  public getJobId(): number {
    return this.jobId;
  }

  public setJobId(jobId: number) {
    this.jobId = jobId;

    this.update.next(this.store);
  }

  public newModel() {
    this.store = JobStore.job;

    this.jobId = 0;
  }

  public async set(job: IJob) {
    this.setJobId(job.id);

    super.set(job);
  }

  public refresh(): Subject<IJob> {
    return super.refresh();
  }

}
