import { Component, OnInit } from '@angular/core';
import { NavController } from '@ionic/angular';
import { Alerts, ETypeAlertToast } from '../providers/alerts';
import { LoginService } from '../services/login/login.service';
import { RecordService } from '../services/record/record.service';
import { UserData } from '../providers/userData';

@Component({
  selector: 'app-login',
  templateUrl: './login.page.html',
  styleUrls: ['./login.page.scss'],
})
export class LoginPage implements OnInit {

  form = {
    email: 'jonathan.estefani@gmail.com',
    password: 'admin',
    // eslint-disable-next-line @typescript-eslint/naming-convention
    user_type_id: 2
  };

  listUserType = RecordService.types.filter(elem => elem.hide === false);

  isLoading: false;

  constructor(private navControl: NavController,
              private loginService: LoginService,
              private alerts: Alerts) { }

  ngOnInit() {}

  async login() {

    await this.alerts.loading();

    try {
      const response = await this.loginService.login(this.form);

      console.log(response);

      localStorage.setItem('token', response.token);

      UserData.setUser(response.user);

      await this.alerts.loading();

      this.navControl.navigateForward('jobs');
    } catch (error) {
      await this.alerts.loading();

      this.alerts.alertToast('E-mail ou senha inválido, favor verificar!', ETypeAlertToast.danger);

      console.log(error);
    }
  }

  register() {
    this.navControl.navigateForward('record');
  }

}
