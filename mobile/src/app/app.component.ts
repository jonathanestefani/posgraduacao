import { Component } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: 'app.component.html',
  styleUrls: ['app.component.scss'],
})
export class AppComponent {

  appPages = [
    {
      title: 'Perfil',
      url: '/profile',
      icon: 'home',
      style: 'business-outline'
    },
    {
      title: 'Serviços',
      url: '/jobs',
      icon: 'home',
      style: 'business-outline'
    },
  ];
  constructor() { }
}
