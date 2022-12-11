import { Injectable } from '@angular/core';
import { Subject } from 'rxjs';
import { IAttendance } from 'src/app/Interfaces/attendance/IAttendance';
import { AbstractStore } from '../abstract/abstract.store';

@Injectable()
export class AttendancesStore extends AbstractStore {
  static attendance: IAttendance = null;

  protected store: IAttendance;
  protected jobId: number;
  protected update: Subject<IAttendance> = new Subject<IAttendance>();

  public refresh(): Subject<IAttendance> {
    return super.refresh();
  }

  public set(attendance: IAttendance) {
    super.set(attendance);
  }

  public get(): IAttendance {
    return this.store;
  }

  public newModel() {
    this.jobId = 0;

    this.store = AttendancesStore.attendance;

    this.update.next(this.store);
  }

  public getJobId(): number {
    return this.jobId;
  }

  public setJobId(jobId: number) {
    this.jobId = jobId;

    this.update.next(this.store);
  }

}
