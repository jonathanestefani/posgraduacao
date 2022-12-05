import { Injectable } from '@angular/core';
import { IScheduleWeek } from 'src/app/Interfaces/schedule/IScheduleWeek';

@Injectable()
export class SchedulesStore {
  private store: Array<IScheduleWeek>;
  private jobId: number;

  constructor() {
    this.newModel();
  }

  public set(schedule: Array<IScheduleWeek>) {
    this.store = { ... this.store, ...schedule };
  }

  public get(): Array<IScheduleWeek> {
    return this.store;
  }

  public getJobId(): number {
    return this.jobId;
  }

  public setJobId(jobId: number) {
    this.jobId = jobId;
  }

  public newModel() {
    this.store = [];

    this.jobId = 0;
  }
}
