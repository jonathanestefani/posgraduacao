import { Injectable } from '@angular/core';
import { catchError } from 'rxjs/operators';
import { Observable, throwError } from 'rxjs';
import { HttpRequest, HttpHandler, HttpEvent, HttpInterceptor } from '@angular/common/http';
import { NavController } from '@ionic/angular';

@Injectable({
  providedIn: 'root'
})
export class TokenInterceptorService {

  constructor(private navCtrl: NavController,) {}
  intercept(
    request: HttpRequest<any>,
    next: HttpHandler
  ): Observable<HttpEvent<any>> {
    const token = localStorage.getItem('token') || "";

    if (token) {
      request = request.clone({
        setHeaders: {
          Authorization: `Bearer ${token}`,
        },
      });
    }
    return next.handle(request).pipe(
      catchError((err) => {
        if (err.status === 401) {
          this.navCtrl.navigateForward('login');
        }
        const error = err.error.message || err.statusText;
        return throwError(error);
      })
    );
  }
}
