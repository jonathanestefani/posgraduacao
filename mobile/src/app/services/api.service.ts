import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from '../../environments/environment';
import { Observable } from 'rxjs';
import { Utils } from './utils';

@Injectable({
    providedIn: 'root'
})
export class ApiService {
    public host: String = environment.host;

    public constructor(private http: HttpClient,
                       private utils: Utils) { }

    private getToken() {
        const auth = localStorage.getItem('token') || "";

        return auth;
    }

    private getHeader(): any {
        const token = this.getToken();

        const headers = new Headers({
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${this.getToken()}`
        })

        return headers;
    }

    public get(resource: string, params: any): Promise<any> {
        return this.http.get(this.host + resource + (params ? '?' : '') + this.utils.buildQuery(params)).toPromise();
    }

    public post(resource: string, params: any): Promise<any> {
        return this.http.post(this.host + resource, params).toPromise();
    }

    public put(resource: string, params: any): Promise<any> {
        return this.http.put(this.host + resource, params).toPromise();
    }

    public delete(resource: string): Promise<any> {
        return this.http.delete(this.host + resource).toPromise();
    }

    public donwload(resource: string, params: any): Observable<any> {
        return this.http.get(this.host + resource + params);
    }
}
