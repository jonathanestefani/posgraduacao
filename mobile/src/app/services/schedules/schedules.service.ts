import { Injectable } from '@angular/core';
import { IScheduleWeek } from 'src/app/Interfaces/schedule/IScheduleWeek';
import { ApiService } from '../api.service';

@Injectable({
  providedIn: 'root',
})
export class SchedulesService {
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
        filters: {
          job_id: jobId,
        },
        all: true
      });

      resolve(this.listScheduleWeek);
    });
  }
}
