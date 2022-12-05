import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { NavController } from '@ionic/angular';
import { Alerts, ETypeAlertToast } from '../providers/alerts';
import { RecordService } from '../services/record/record.service';
import { UserData } from '../providers/userData';
import { IUser } from '../Interfaces/User/IUser';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.page.html',
  styleUrls: ['./profile.page.scss'],
})
export class ProfilePage implements OnInit {

  form: IUsclearer = {
    id: 0,
    user_type_id: 0,
    name: '',
    email: '',
    password: '',
    status: 0
  };

  isLoading = false;

  constructor(private navControl: NavController,
              public router: Router,
              private recordService: RecordService,
              private alerts: Alerts) {}

  ngOnInit() {
    this.form = UserData.getUser();

    console.log(UserData.getUser());
  }

  async save() {

    await this.alerts.loading();

    try {
      const response = await this.recordService.record(this.form);

      console.log(response);

      await this.alerts.loading();

      this.alerts.alertToast('Cadastro efetuado com sucesso!', ETypeAlertToast.danger);

      this.navControl.navigateForward('login');
    } catch (error) {
      await this.alerts.loading();

      const resp = String(error).replace(/[,]/, '<br />');
      this.alerts.alertToast(resp, ETypeAlertToast.danger);

      console.log(error);
    }
  }

}
