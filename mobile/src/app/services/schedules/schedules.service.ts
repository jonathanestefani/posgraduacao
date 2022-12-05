import { Injectable } from '@angular/core';
import { IListDaysOfTheWeek } from 'src/app/Interfaces/schedule/IListDaysOfTheWeek';
import { IScheduleWeek } from 'src/app/Interfaces/schedule/IScheduleWeek';
import { ApiService } from '../api.service';

@Injectable({
  providedIn: 'root',
})
export class SchedulesService {
  static listDaysOfTheWeek: Array<IListDaysOfTheWeek> = [
    { id: 'monday', name: 'Segunda' },
    { id: 'tuesday', name: 'Terça' },
    { id: 'wednesday', name: 'Quarta' },
    { id: 'thursday', name: 'Quinta' },
    { id: 'friday', name: 'Sexta' },
    { id: 'saturday', name: 'Sábado' },
    { id: 'sunday', name: 'Domingo' },
  ];

  private resource = 'schedules';
  private subresourceTime = 'time';
  private subresourceWeek = 'week';
  private listScheduleWeek: Array<IScheduleWeek>;

  constructor(private http: ApiService) {}

  public getWeekSchedules(params: any = {}) {
    return this.http.get(this.resource + '/' + this.subresourceWeek, params);
  }

  public requestWeekSchedule(params: any = {}) {
    return this.http.post(this.resource + '/' + this.subresourceWeek, params);
  }

  public getTimeSchedules(params: any = {}) {
    return this.http.get(this.resource + '/' + this.subresourceTime, params);
  }

  public requestTimeSchedule(params: any = {}) {
    return this.http.post(this.resource + '/' + this.subresourceTime, params);
  }

  public getDaysWeekSchedulesByJobId(jobId: number): Promise<any> {
    return new Promise(async (resolve, reject) => {
      this.listScheduleWeek = await this.getWeekSchedules({
        filter: {
          job_id: jobId,
        },
        with: ['times']
      });

      resolve(this.listScheduleWeek);
    });
  }
}
