import { Injectable } from '@angular/core';
import { ApiService } from '../api.service';

@Injectable({
  providedIn: 'root'
})
export class JobsService {

  resource = 'jobs';

  constructor(private http: ApiService) { }

  public getJobs(params = {}) {
    return this.http.get(this.resource, params);
  }
}
