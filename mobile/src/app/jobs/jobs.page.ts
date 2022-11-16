import { Component, OnInit } from '@angular/core';
import { NavController } from '@ionic/angular';
import { Alertas } from '../providers/alertas';
import { JobsService } from '../services/jobs/jobs.service';

@Component({
  selector: 'app-jobs',
  templateUrl: './jobs.page.html',
  styleUrls: ['./jobs.page.scss'],
})
export class JobsPage implements OnInit {

  listJobs: [];
  isLoading: false;
  filters = {
    search: ''
  };

  constructor(private navControl: NavController,
              private jobsService: JobsService,
              private alertas: Alertas) { }

  ngOnInit() {
    this.getListAllJobs();
  }

  async getListAllJobs() {

    await this.alertas.loadShow();

    try {
      const response = await this.jobsService.getJobs({
        filters: { ...this.filters }
      });

      console.log(response);

      this.listJobs = response.data;

      await this.alertas.loadStop();
    } catch (error) {
      await this.alertas.loadStop();

      this.alertas.toastShow("Houve um problema ao tentar buscar os serviços disponíveis!", "E");

      console.log(error);
    }
  }

  itemSelected(job) {
    console.log(job);

    localStorage.setItem('job_details', JSON.stringify(job));

    this.navControl.navigateForward('/jobs/details');
  }

}
