import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
// import { HTTP } from '@ionic-native/http/ngx';
import { HTTP } from '@awesome-cordova-plugins/http/ngx';
import { environment } from '../../environments/environment.prod';
import { Observable } from 'rxjs';
import { Utils } from '../providers/utils';
import { Alerts } from '../providers/alerts';

@Injectable({
  providedIn: 'root',
})
export class ApiService {
  public host: string = environment.host;
  private token = '';

  public constructor(
    private http: HTTP,
    private utils: Utils,
    private alert: Alerts
  ) {
    this.http.setServerTrustMode('nocheck');
    this.http.setRequestTimeout(2000);
    this.http.setDataSerializer('json');
  }

  public get(resource: string, params: any): Promise<any> {
    try {
      return new Promise((resolve, reject) => {
        this.http
          .get(
            this.host +
              resource +
              (params ? '?' : '') +
              this.utils.buildQuery(params),
            {},
            this.getHeader()
          )
          .then((response) => {
            try {
              resolve(JSON.parse(response.data));
            } catch (error) {
              resolve(response.data);
            }

          })
          .catch((httpError) => {
            reject(httpError);
          });
      });
    } catch (error) {
      this.alert.stopLoading();
    }
  }

  public post(resource: string, params: any): Promise<any> {
    try {
      return new Promise((resolve, reject) => {
        this.http
          .post(this.host + resource, params, this.getHeader())
          .then((response) => {
            try {
              resolve(JSON.parse(response.data));
            } catch (error) {
              resolve(response.data);
            }

          })
          .catch((httpError) => {
            reject(httpError);
          });
      });
    } catch (error) {
      this.alert.stopLoading();
    }
  }

  public put(resource: string, params: any): Promise<any> {
    try {
      return new Promise((resolve, reject) => {
        this.http
          .put(this.host + resource, params, this.getHeader())
          .then((response) => {
            try {
              resolve(JSON.parse(response.data));
            } catch (error) {
              resolve(response.data);
            }

          })
          .catch((httpError) => {
            reject(httpError);
          });
      });
    } catch (error) {
      this.alert.stopLoading();
    }
  }

  public delete(resource: string): Promise<any> {
    try {
      return new Promise((resolve, reject) => {
        this.http
          .delete(this.host + resource, {}, this.getHeader())
          .then((response) => {
            try {
              resolve(JSON.parse(response.data));
            } catch (error) {
              resolve(response.data);
            }

          })
          .catch((httpError) => {
            reject(httpError);
          });
      });
    } catch (error) {
      this.alert.stopLoading();
    }
  }

  public setToken(token) {
    this.token = token;
  }

  private getToken() {
    return this.token;
  }

  private getHeader(): any {
    const token = this.getToken();

    if (token && token !== '') {
      //const headers = new Headers(
      return {
        'Content-Type': 'application/json',
        Authorization: `Bearer ${this.getToken()}`,
      };
      //);
    }

    return {};
  }
}
