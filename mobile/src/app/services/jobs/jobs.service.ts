import { Injectable } from '@angular/core';
import { IJob } from 'src/app/jobs/record/about/interface/IJob';
import { ApiService } from '../api.service';

@Injectable({
  providedIn: 'root'
})
export class JobsService {

  resource = 'jobs';

  constructor(private http: ApiService) { }

  public save(params) {
    return this.http.post(this.resource, params);
  }

  public getJobById(id: number) {
    return this.http.get(this.resource + '/' + id, {});
  }

  public getJobs(params = {}) {
    return this.http.get(this.resource, params);
  }
}
