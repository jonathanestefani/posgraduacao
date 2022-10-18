import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { NavController } from '@ionic/angular';
import { Alertas } from '../providers/alertas';
import { RecordService } from '../services/record/record.service';
import { UserData } from '../services/UserData';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.page.html',
  styleUrls: ['./profile.page.scss'],
})
export class ProfilePage implements OnInit {

  form = {
    id: 0,
    user_type_id: 0,
    name: "",
    email: "",
    password: "",
    status: 0
  };

  isLoading = false;

  constructor(private navControl: NavController,
              public router: Router,
              private recordService: RecordService,
              private alertas: Alertas) {}

  ngOnInit() {
    this.form = UserData.getUser();

    console.log(UserData.getUser());
  }

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
