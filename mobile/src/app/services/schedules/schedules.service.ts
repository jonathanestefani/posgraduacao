import { Injectable } from '@angular/core';
import { ApiService } from '../api.service';

@Injectable({
  providedIn: 'root'
})
export class SchedulesService {

  resource = 'schedules';

  constructor(private http: ApiService) { }

  public getSchedules(params = {}) {
    return this.http.get(this.resource, params);
  }

  public requestSchedule(params = {}) {
    return this.http.post(this.resource, params);
  }
}
