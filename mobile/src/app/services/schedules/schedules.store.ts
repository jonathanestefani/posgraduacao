import { Injectable } from '@angular/core';
import { Subject } from 'rxjs';
import { IListDaysOfTheWeek } from 'src/app/Interfaces/schedule/IListDaysOfTheWeek';
import { IScheduleTime } from 'src/app/Interfaces/schedule/IScheduleTime';
import { IScheduleWeek } from 'src/app/Interfaces/schedule/IScheduleWeek';
import { AbstractStore } from '../abstract/abstract.store';

@Injectable()
export class SchedulesStore extends AbstractStore {
  static schedule: Array<IScheduleWeek> = [];

  static listDaysOfTheWeek: Array<IListDaysOfTheWeek> = [
    { id: 'monday', name: 'Segunda' },
    { id: 'tuesday', name: 'Terça' },
    { id: 'wednesday', name: 'Quarta' },
    { id: 'thursday', name: 'Quinta' },
    { id: 'friday', name: 'Sexta' },
    { id: 'saturday', name: 'Sábado' },
    { id: 'sunday', name: 'Domingo' },
  ];

  protected store: Array<IScheduleWeek>;
  protected jobId: number;
  protected update: Subject<Array<IScheduleWeek>> = new Subject<Array<IScheduleWeek>>();

  public refresh(): Subject<Array<IScheduleWeek>> {
    return super.refresh();
  }

  public set(scheduleWeek: Array<IScheduleWeek>) {
    super.set([ ... this.store, ...scheduleWeek ]);
  }

  public get(): Array<IScheduleWeek> {
    return this.store;
  }

  public newModel() {
    this.jobId = 0;

    this.store = SchedulesStore.schedule;

    this.update.next(this.store);
  }

  public getJobId(): number {
    return this.jobId;
  }

  public setJobId(jobId: number) {
    this.jobId = jobId;

    this.update.next(this.store);
  }

  public getNewAppointmentScheduleTemplate(): IScheduleTime {
    return {
        id: 0,
        job_id: this.jobId,
        schedule_week_id: 0,
        time: '00:00'
      };
  }

  getDayWeek(dayWeek: string) {
    const day = SchedulesStore.listDaysOfTheWeek.filter(elem => elem.id ===  dayWeek)[0];

    if (day == null) {
      return 'Dia da semana não encontrado!';
    }

    return day.name;
  }

}
