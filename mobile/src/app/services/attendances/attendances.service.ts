import { Injectable } from '@angular/core';
import { IAttendance } from 'src/app/Interfaces/attendance/IAttendance';
import { ApiService } from '../api.service';

@Injectable({
  providedIn: 'root'
})
export class AttendancesService {

  private resource = 'attendances';

  constructor(private http: ApiService) { }

  public getAttendances(params: any = {}) {
    return this.http.get(this.resource, params);
  }

  public requestAttendance(params: IAttendance = {}) {
    return this.http.post(this.resource, params);
  }

  public requestCancelAttendance(params: IAttendance = {}) {
    return this.http.post(this.resource, params);
  }
}
