import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { NavController } from '@ionic/angular';
import { Alertas } from '../providers/alertas';
import { LoginService } from '../services/login/login.service';
import { RecordService } from '../services/record/record.service';
import { UserData } from '../services/UserData';

@Component({
  selector: 'app-record',
  templateUrl: './record.page.html',
  styleUrls: ['./record.page.scss'],
})
export class RecordPage implements OnInit {

  form = {
    user_type_id: 0,
    name: "",
    email: "jonathan.estefani@gmail.com",
    password: "admin",
    status: 1
  };

  isLoading: false;

  constructor(private navControl: NavController,
              public router: Router,
              private recordService: RecordService,
              private alertas: Alertas) { }

  ngOnInit() {}

  async save() {

    await this.alertas.loadShow();

    try {
      const response = await this.recordService.record(this.form);   

      console.log(response);

      await this.alertas.loadStop();

      this.alertas.toastShow("Cadastro efetuado com sucesso!");

      this.navControl.navigateForward('login');
    } catch (error) {
      await this.alertas.loadStop();

      const resp = String(error).replace(/[,]/, '<br />');
      this.alertas.toastShow(resp, "E");

      console.log(error);
    }
  }

}
