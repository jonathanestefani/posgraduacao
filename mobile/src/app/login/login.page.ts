import { Component, OnInit } from '@angular/core';
import { NavController } from '@ionic/angular';
import { Alertas } from '../providers/alertas';
import { LoginService } from '../services/login/login.service';
import { RecordService } from '../services/record/record.service';
import { UserData } from '../services/UserData';

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

  listUserType = RecordService.types.filter(elem => elem.hide == false);

  isLoading: false;

  constructor(private navControl: NavController,
              private loginService: LoginService,
              private alertas: Alertas) { }

  ngOnInit() {}

  async login() {

    await this.alertas.loadShow();

    try {
      const response = await this.loginService.login(this.form);   

      console.log(response);

      localStorage.setItem('token', response.token);

      UserData.setUser(response.user);

      await this.alertas.loadStop();

      this.navControl.navigateForward('jobs');
    } catch (error) {
      await this.alertas.loadStop();

      this.alertas.toastShow("E-mail ou senha inválido, favor verificar!", "E");

      console.log(error);
    }
  }

  register() {
    this.navControl.navigateForward('record');
  }

}
