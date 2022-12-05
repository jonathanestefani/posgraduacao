import { Component, OnInit } from '@angular/core';
import { NavController } from '@ionic/angular';
import { IJob } from '../Interfaces/job/interface/IJob';
import { Alerts, ETypeAlert } from '../providers/alerts';
import { JobStore } from '../services/jobs/job.store';
import { JobsService } from '../services/jobs/jobs.service';

@Component({
  selector: 'app-jobs',
  templateUrl: './jobs.page.html',
  styleUrls: ['./jobs.page.scss'],
})
export class JobsPage implements OnInit {

  listJobs: Array<IJob> = [];
  isLoading: false;
  filters = {
    search: ''
  };

  constructor(private navControl: NavController,
              private jobsService: JobsService,
              private jobStore: JobStore,
              private alerts: Alerts) { }

  ngOnInit() {
    this.getListAllJobs();
  }

  async getListAllJobs() {

    await this.alerts.loading();

    try {
      const response = await this.jobsService.getJobs({
        filters: { ...this.filters }
      });

      console.log(response);

      this.listJobs = response.data;

      await this.alerts.loading();
    } catch (error) {
      await this.alerts.loading();

      this.alerts.alert('Atenção', 'Houve um problema ao tentar buscar os serviços disponíveis!', ETypeAlert.ok);

      console.log(error);
    }
  }

  itemSelected(job) {
    console.log(job);

    this.jobStore.set(job);

    // localStorage.setItem('job_details', JSON.stringify(job));

    this.navControl.navigateForward('/jobs/details');
  }

}
