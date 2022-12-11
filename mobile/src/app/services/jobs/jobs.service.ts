import { Injectable } from '@angular/core';
import { ApiService } from '../api.service';

@Injectable({
  providedIn: 'root'
})
export class JobsService {
  private resource = 'jobs';

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
