import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { NavController } from '@ionic/angular';
import { Alertas } from 'src/app/providers/alertas';
import { JobsService } from 'src/app/services/jobs/jobs.service';
import { UserData } from 'src/app/services/UserData';
import { IJob } from '../../../Interfaces/job/interface/IJob';

@Component({
  selector: 'app-about',
  templateUrl: './about.page.html',
  styleUrls: ['./about.page.scss'],
})
export class AboutPage implements OnInit {
  job: IJob = JobsService.job;

  constructor(private navControl: NavController,
              private activeRoute: ActivatedRoute,
              public router: Router,
              private jobService: JobsService,
              private alertas: Alertas) {

    this.job.job_info = [
      { type: 'desc', name: 'Descrição', text: '', value: 0 },
      { type: 'number', name: 'Valor', text: '', value: 0 },
    ];

  }

  ngOnInit() {
    console.log(this.activeRoute.snapshot.params.id);

    this.getById();
  }

  async getById() {
    if (this.activeRoute.snapshot.params.id) {
      const data = await this.jobService.getJobById( this.activeRoute.snapshot.params.id );

      if (data) {
        this.job = data;
      }
    }
  }

  async save() {
    await this.alertas.loadShow();

    try {
      const userData = UserData.getUser();

      if (this.job.id === 0) {
        delete this.job.id;
      }

      this.job.person_id = userData.id;

      const response = await this.jobService.save(this.job);

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
