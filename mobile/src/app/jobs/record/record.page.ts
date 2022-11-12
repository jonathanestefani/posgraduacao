import { Component, OnInit, ViewChild } from '@angular/core';
import { Router } from '@angular/router';
import { IonTabs, NavController } from '@ionic/angular';
import { Alertas } from 'src/app/providers/alertas';
import { RecordService } from 'src/app/services/record/record.service';

@Component({
  selector: 'app-record',
  templateUrl: './record.page.html',
  styleUrls: ['./record.page.scss'],
})
export class RecordPage implements OnInit {
  @ViewChild('myTabs') tabRef: IonTabs;

  isLoading: false;

  form = {
    id: 0,
    name: ''
  };

  constructor(private navControl: NavController,
    public router: Router,
    private recordService: RecordService,
    private alertas: Alertas) { }

  ngOnInit() {
  }

  async save() {

    await this.alertas.loadShow();

    try {
      const response = await this.recordService.record(this.form);

      console.log(response);

      await this.alertas.loadStop();

      this.alertas.toastShow('Cadastro efetuado com sucesso!');

      this.navControl.navigateForward('login');
    } catch (error) {
      await this.alertas.loadStop();

      const resp = String(error).replace(/[,]/, '<br />');
      this.alertas.toastShow(resp, 'E');

      console.log(error);
    }
  }

}
