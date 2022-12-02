import { Injectable } from '@angular/core';
import { ApiService } from '../api.service';

@Injectable({
  providedIn: 'root'
})
export class LoginService {

  resource = 'login';

  constructor(private http: ApiService) { }

  public login(params: any = {}) {
    return this.http.post(this.resource, params);
  }
}
