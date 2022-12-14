import { Component, OnInit } from '@angular/core';
import { InfiniteScrollCustomEvent, NavController } from '@ionic/angular';
import { IJob } from '../Interfaces/job/interface/IJob';
import { Alerts, ETypeAlert } from '../providers/alerts';
import { UserData } from '../providers/userData';
import { JobStore } from '../services/jobs/job.store';
import { JobsService } from '../services/jobs/jobs.service';
import { SchedulesStore } from '../services/schedules/schedules.store';

@Component({
  selector: 'app-jobs',
  templateUrl: './jobs.page.html',
  styleUrls: ['./jobs.page.scss'],
})
export class JobsPage implements OnInit {
  listJobs: Array<IJob> = [];
  isLoading: false;
  filters = {
    name: '',
  };

  limitePerPage = 25;
  numberOfLines = 0;
  proxPage = 1;
  lastPage = 1;

  constructor(
    private navControl: NavController,
    private jobsService: JobsService,
    public scheduleStore: SchedulesStore,
    private jobStore: JobStore,
    private alerts: Alerts
  ) {}

  ngOnInit() {
    this.proxPage = 1;

    this.listJobs = [];

    this.getListAllJobs();
  }

  onSearch($event) {
    if ($event.keyCode === 13) {
      this.listJobs = [];
      this.proxPage = 1;

      this.getListAllJobs();
    }
  }

  getPagination() {
    return {
      page: this.proxPage,
    };
  }

  onIonInfinite(ev) {
    setTimeout(() => {
      (ev as InfiniteScrollCustomEvent).target.complete();
    }, 500);

    this.getListAllJobs();
  }

  async getListAllJobs() {
    if (this.proxPage > this.lastPage) {
      return false;
    }

    try {
      await this.alerts.loading();

      const response = await this.jobsService.getJobs({
        filters: { ...this.filters },
        ...this.getPagination()
      });

      console.log(response);

      this.listJobs = [ ...this.listJobs, ...response.data ];

      this.numberOfLines = response.total;
      this.proxPage += 1;
      this.lastPage = response.last_page;

      await this.alerts.stopLoading();
    } catch (error) {
      await this.alerts.stopLoading();

      this.alerts.alert(
        'Aten????o',
        'Houve um problema ao tentar buscar os servi??os dispon??veis!',
        ETypeAlert.ok
      );

      console.log(error);
    }
  }

  isEdit(job: IJob) {
    const user = UserData.getUser();

    return user.id === job.person_id;
  }

  async itemSelected(job) {
    console.log(job);

    this.jobStore.newModel();

    await this.jobStore.set(job);

    this.scheduleStore.newModel();

    if (this.isEdit(job)) {
      await this.navControl.navigateForward('/jobs/record/about/' + job.id);
    } else {
      await this.navControl.navigateForward('/jobs/details');
    }
  }
}
