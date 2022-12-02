import { Injectable } from '@angular/core';
import { IJob } from 'src/app/Interfaces/job/interface/IJob';
import { ApiService } from '../api.service';

@Injectable({
  providedIn: 'root'
})
export class JobsService {
  static job: IJob = {
    id: 0,
    name: '',
    status: 1,
    person_id: 0,
    job_info: []
  };

  resource = 'jobs';

  constructor(private http: ApiService) { }

  public save(params: any = {}) {
    return this.http.post(this.resource, params);
  }

  public getJobById(id: number) {
    return this.http.get(this.resource + '/' + id, {});
  }

  public getJobs(params: any = {}) {
    return this.http.get(this.resource, params);
  }
}
