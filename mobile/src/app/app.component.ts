import { Component } from '@angular/core';
import { EUserType } from './Interfaces/User/enum/EUserType';
import { UserData } from './providers/userData';

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
    {
      title: 'Cadastrar Serviço',
      url: '/jobs/record/about',
      icon: 'home',
      style: 'business-outline',
      restriction_type_user: [EUserType.admin, EUserType.company]
    },
    {
      title: 'Minha agenda',
      url: '/schedule',
      icon: 'home',
      style: 'business-outline'
    },
    {
      title: 'Solicitações',
      url: '/requests',
      icon: 'home',
      style: 'business-outline',
      restriction_type_user: [EUserType.admin, EUserType.company]
    },
  ];

  constructor() {}

  restrictionCheck(restriction: any = []) {
    try {
        const userType = UserData.getUser().user_type.type;

        return restriction.includes(userType);
    } catch (error) {
        console.log(error);
    }
  }
}
