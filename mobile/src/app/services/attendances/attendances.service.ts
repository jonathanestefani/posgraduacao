import { Injectable } from '@angular/core';
import { ApiService } from '../api.service';

@Injectable({
  providedIn: 'root'
})
export class AttendancesService {

  resource = 'attendances';

  constructor(private http: ApiService) { }

  public getAttendances(params = {}) {
    return this.http.get(this.resource, params);
  }

  public requestAttendance(params = {}) {
    return this.http.post(this.resource, params);
  }
}
