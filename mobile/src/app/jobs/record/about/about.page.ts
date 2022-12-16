import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { NavController } from '@ionic/angular';
import { Alerts, ETypeAlertToast } from 'src/app/providers/alerts';
import { JobsService } from 'src/app/services/jobs/jobs.service';
import { UserData } from 'src/app/providers/userData';
import { IJob } from '../../../Interfaces/job/interface/IJob';
import { JobStore } from 'src/app/services/jobs/job.store';
import { SchedulesStore } from 'src/app/services/schedules/schedules.store';

@Component({
  selector: 'app-about',
  templateUrl: './about.page.html',
  styleUrls: ['./about.page.scss'],
})
export class AboutPage implements OnInit {
  job: IJob = JobStore.job;

  constructor(private navControl: NavController,
              private activeRoute: ActivatedRoute,
              public router: Router,
              private jobService: JobsService,
              private jobStore: JobStore,
              private scheduleStore: SchedulesStore,
              private alerts: Alerts) {}

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

      if (!data.job_info) {
        this.job.job_info = JobStore.job.job_info;
      }
    } else {
      this.jobStore.newModel();

      this.job = this.jobStore.get();
    }
  }

  async save() {
    try {
      const userData = UserData.getUser();

      if (this.job.id === 0) {
        delete this.job.id;
        delete this.job.person;
      }

      this.job.person_id = userData.id;

      await this.alerts.loading();

      const response = await this.jobService.save(this.job);

      await this.alerts.stopLoading();


      this.jobStore.set(response);

      this.scheduleStore.newModel();

      console.log('/jobs/record/about/' + response.id);

      this.navControl.navigateForward('/jobs/record/about/' + response.id);
    } catch (error) {
      await this.alerts.stopLoading();

      this.alerts.alertToast('Houve um problema ao tentar buscar os serviços disponíveis!', ETypeAlertToast.danger);

      console.log(error);
    }
  }
}
