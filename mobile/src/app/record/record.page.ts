import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { NavController } from '@ionic/angular';
import { Alerts, ETypeAlertToast } from '../providers/alerts';
import { RecordService } from '../services/record/record.service';

@Component({
  selector: 'app-record',
  templateUrl: './record.page.html',
  styleUrls: ['./record.page.scss'],
})
export class RecordPage implements OnInit {

  form = {
    user_type_id: 0,
    name: '',
    email: 'jonathan.estefani@gmail.com',
    password: 'admin',
    status: 1
  };

  listUserType = RecordService.types.filter(elem => elem.hide === false);

  isLoading: false;

  constructor(private navControl: NavController,
              public router: Router,
              private recordService: RecordService,
              private alerts: Alerts) { }

  ngOnInit() {}

  async save() {

    await this.alerts.loading();

    try {
      const response = await this.recordService.record(this.form);

      console.log(response);

      await this.alerts.loading();

      this.alerts.alertToast('Cadastro efetuado com sucesso!');

      this.navControl.navigateForward('login');
    } catch (error) {
      await this.alerts.loading();

      const resp = String(error).replace(/[,]/, '<br />');
      this.alerts.alertToast(resp, ETypeAlertToast.danger);

      console.log(error);
    }
  }

}
