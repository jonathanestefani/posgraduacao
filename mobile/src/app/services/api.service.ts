import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from '../../environments/environment';
import { Observable } from 'rxjs';
import { Utils } from '../providers/utils';
import { Alerts } from '../providers/alerts';

@Injectable({
    providedIn: 'root'
})
export class ApiService {
    public host: string = environment.host;

    public constructor(private http: HttpClient,
                       private utils: Utils,
                       private alert: Alerts) { }

    public get(resource: string, params: any): Promise<any> {
        try {
            return this.http.get(this.host + resource + (params ? '?' : '') + this.utils.buildQuery(params)).toPromise();
        } catch (error) {
            this.alert.stopLoading();
        }
    }

    public post(resource: string, params: any): Promise<any> {
        try {
            return this.http.post(this.host + resource, params).toPromise();
        } catch (error) {
            this.alert.stopLoading();
        }
    }

    public put(resource: string, params: any): Promise<any> {
        try {
            return this.http.put(this.host + resource, params).toPromise();
        } catch (error) {
            this.alert.stopLoading();
        }
    }

    public delete(resource: string): Promise<any> {
        try {
            return this.http.delete(this.host + resource).toPromise();
        } catch (error) {
            this.alert.stopLoading();
        }
    }

    public donwload(resource: string, params: any): Observable<any> {
        try {
            return this.http.get(this.host + resource + params);
        } catch (error) {
            this.alert.stopLoading();
        }
    }

    private getToken() {
        const auth = localStorage.getItem('token') || '';

        return auth;
    }

    private getHeader(): any {
        const token = this.getToken();

        const headers = new Headers({
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${this.getToken()}`
        });

        return headers;
    }
}
