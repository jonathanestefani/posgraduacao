import { Injectable } from '@angular/core';
import { ApiService } from '../api.service';

@Injectable({
  providedIn: 'root'
})
export class SchedulesService {

  static listDaysOfTheWeek = [
    {id: 1, name: 'Segunda'},
    {id: 2, name: 'Terça'},
    {id: 3, name: 'Quarta'},
    {id: 4, name: 'Quinta'},
    {id: 5, name: 'Sexta'},
    {id: 6, name: 'Sábado'},
    {id: 7, name: 'Domingo'},
  ];

  resource = 'schedules';

  constructor(private http: ApiService) { }

  public getSchedules(params = {}) {
    return this.http.get(this.resource, params);
  }

  public requestSchedule(params = {}) {
    return this.http.post(this.resource, params);
  }
}
