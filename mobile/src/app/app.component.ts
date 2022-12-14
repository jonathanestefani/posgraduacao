import { Component } from '@angular/core';
import { EUserType } from './Interfaces/User/enum/EUserType';
import { IUser } from './Interfaces/User/IUser';
import { UserData } from './providers/userData';

@Component({
  selector: 'app-root',
  templateUrl: 'app.component.html',
  styleUrls: ['app.component.scss'],
})
export class AppComponent {

  user: IUser = {};

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
      // eslint-disable-next-line @typescript-eslint/naming-convention
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
      // eslint-disable-next-line @typescript-eslint/naming-convention
      restriction_type_user: [EUserType.admin, EUserType.company]
    },
  ];

  constructor() {
    this.user = UserData.getUser();
  }

  restrictionCheck(restriction: any = []) {
    try {
      if (this.user.id) {
        const userType = this.user.user_type.type;

        return restriction.includes(userType);
      }
    } catch (error) {
        console.log(error);
    }
  }
}
