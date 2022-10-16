import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { RouteReuseStrategy } from '@angular/router';

import { IonicModule, IonicRouteStrategy } from '@ionic/angular';

import { AppComponent } from './app.component';
import { AppRoutingModule } from './app-routing.module';

import { ApiService } from './services/api.service';
import { Utils } from './services/utils';
import { HttpClientModule, HTTP_INTERCEPTORS } from '@angular/common/http';
import { Alertas } from './providers/alertas';
import { TokenInterceptorService } from './interceptors/token-interceptor.service';
import { UserData } from './services/UserData';

@NgModule({
  declarations: [AppComponent],
  imports: [
    BrowserModule,
    IonicModule.forRoot(),
    AppRoutingModule,
    HttpClientModule
  ],
  providers: [
    { provide: RouteReuseStrategy, useClass: IonicRouteStrategy },
    {
      provide: HTTP_INTERCEPTORS,
      useClass: TokenInterceptorService,
      multi: true,
    },
    Utils,
    Alertas,
    ApiService,
    UserData
  ],
  bootstrap: [AppComponent],
})
export class AppModule {}
