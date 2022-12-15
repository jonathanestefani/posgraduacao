import { Component, OnInit } from '@angular/core';
import { MenuController, NavController } from '@ionic/angular';
import { Alerts, ETypeAlertToast } from '../providers/alerts';
import { LoginService } from '../services/login/login.service';
import { RecordService } from '../services/record/record.service';
import { UserData } from '../providers/userData';
import { ApiService } from '../services/api.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.page.html',
  styleUrls: ['./login.page.scss'],
})
export class LoginPage implements OnInit {

  form = {
    email: 'jonathan.estefani@gmail.com',
    password: 'empresa',
    // eslint-disable-next-line @typescript-eslint/naming-convention
    user_type_id: 3
  };

  listUserType = RecordService.types.filter(elem => elem.hide === false);

  isLoading = false;

  constructor(private navControl: NavController,
              private loginService: LoginService,
              private http: ApiService,
              private menu: MenuController,
              private alerts: Alerts) { }

  ngOnInit() {}

  ionViewWillEnter() {
    this.menu.enable(false);
  }

  async login() {

    await this.alerts.loading();

    try {
      const response = await this.loginService.login(this.form);

      UserData.setUser(response.user);

      this.http.setToken(response.token);

      await this.alerts.stopLoading();

      this.menu.enable(true);

      this.navControl.navigateForward('jobs');
    } catch (error) {
      await this.alerts.stopLoading();

      this.alerts.alertToast('E-mail ou senha inválido, favor verificar!', ETypeAlertToast.danger);

      console.log(error);
    }
  }

  register() {
    this.navControl.navigateForward('record');
  }

}
