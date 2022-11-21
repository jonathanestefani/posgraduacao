import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { NavController } from '@ionic/angular';
import { Alertas } from 'src/app/providers/alertas';
import { JobsService } from 'src/app/services/jobs/jobs.service';
import { UserData } from 'src/app/services/UserData';
import { IJob } from './interface/IJob';
import { IJobInfo } from './interface/IJobInfo';

@Component({
  selector: 'app-about',
  templateUrl: './about.page.html',
  styleUrls: ['./about.page.scss'],
})
export class AboutPage implements OnInit {
  form: IJob = {
    id: 0,
    name: '',
    status: 1,
    person_id: 0,
    job_info: [
      { name: 'Descrição', text: '', value: 0 },
      { name: 'Valor', text: '', value: 0 },
    ]
  };

  constructor(private navControl: NavController,
              private activeRoute: ActivatedRoute,
              public router: Router,
              private jobService: JobsService,
              private alertas: Alertas) {}

  ngOnInit() {
    console.log(this.activeRoute.snapshot.params.id);

    this.getById();
  }

  async getById() {
    if (this.activeRoute.snapshot.params.id) {
      const data = await this.jobService.getJobById( this.activeRoute.snapshot.params.id );

      if (data) {
        this.form = data;
      }
    }
  }

  async save() {
    await this.alertas.loadShow();

    try {
      const userData = UserData.getUser();

      if (this.form.id === 0) {
        delete this.form.id;
      }

      this.form.person_id = userData.id;

      const response = await this.jobService.save(this.form);

      await this.alertas.loadStop();

      console.log('/jobs/record/about/' + response.id);

      this.navControl.navigateForward('/jobs/record/about/' + response.id);
    } catch (error) {
      await this.alertas.loadStop();

      this.alertas.toastShow('Houve um problema ao tentar buscar os serviços disponíveis!', 'E');

      console.log(error);
    }
  }
}
