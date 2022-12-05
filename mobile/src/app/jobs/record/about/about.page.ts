import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { NavController } from '@ionic/angular';
import { Alerts, ETypeAlertToast } from 'src/app/providers/alerts';
import { JobsService } from 'src/app/services/jobs/jobs.service';
import { UserData } from 'src/app/providers/userData';
import { IJob } from '../../../Interfaces/job/interface/IJob';
import { JobStore } from 'src/app/services/jobs/job.store';

@Component({
  selector: 'app-about',
  templateUrl: './about.page.html',
  styleUrls: ['./about.page.scss'],
})
export class AboutPage implements OnInit {
  job: IJob;

  constructor(private navControl: NavController,
              private activeRoute: ActivatedRoute,
              public router: Router,
              private jobService: JobsService,
              private jobStore: JobStore,
              private alerts: Alerts) {

    this.job.job_info = [
      { type: 'desc', name: 'Descrição', text: '', value: 0 },
      { type: 'number', name: 'Valor', text: '', value: 0 },
    ];

  }

  ngOnInit() {
    console.log(this.activeRoute.snapshot.params.id);

    this.loadJobById();
  }

  async loadJobById() {
    if (this.activeRoute.snapshot.params.id) {
      const data = await this.jobService.getJobById( this.activeRoute.snapshot.params.id );

      if (data) {
        this.job = data;
      }
    } else {
      this.jobStore.newModel();

      this.job = this.jobStore.get();
    }
  }

  async save() {
    await this.alerts.loading();

    try {
      const userData = UserData.getUser();

      if (this.job.id === 0) {
        delete this.job.id;
      }

      this.job.person_id = userData.id;

      const response = await this.jobService.save(this.job);

      await this.alerts.loading();

      console.log('/jobs/record/about/' + response.id);

      this.navControl.navigateForward('/jobs/record/about/' + response.id);
    } catch (error) {
      await this.alerts.loading();

      this.alerts.alertToast('Houve um problema ao tentar buscar os serviços disponíveis!', ETypeAlertToast.danger);

      console.log(error);
    }
  }
}
