import { Component, OnInit, ViewChild } from '@angular/core';
import { Router } from '@angular/router';
import { IonTabs, NavController } from '@ionic/angular';
import { IJob } from 'src/app/Interfaces/job/interface/IJob';
import { Alerts, ETypeAlertToast } from 'src/app/providers/alerts';
import { JobStore } from 'src/app/services/jobs/job.store';
import { SchedulesService } from 'src/app/services/schedules/schedules.service';
import { SchedulesStore } from 'src/app/services/schedules/schedules.store';
import { AboutPage } from './about/about.page';
import { SchedulesPage } from './schedules/schedules.page';

@Component({
  selector: 'app-details',
  templateUrl: './details.page.html',
  styleUrls: ['./details.page.scss'],
})
export class DetailsPage implements OnInit {
  @ViewChild('myTabs') tabRef: IonTabs;

  job: IJob = JobStore.job;

  tabAbout: any;
  tabSchedule: any;

  constructor(public router: Router,
              private jobStore: JobStore,
              private schedulesService: SchedulesService,
              public scheduleStore: SchedulesStore,
              private navControl: NavController,
              private alerts: Alerts) {
    this.tabAbout = AboutPage;
    this.tabSchedule = SchedulesPage;
  }

  async ngOnInit() {
    this.job = this.jobStore.get();

    await this.getListAllSchedules();

    this.tabRef.select('about');
  }

  async getListAllSchedules() {
    try {
      await this.alerts.loading();

      const response = await this.schedulesService.getDaysWeekSchedulesByJobId(this.job.id);

      this.scheduleStore.set(response);

      await this.alerts.stopLoading();
    } catch (error) {
      await this.alerts.stopLoading();

      this.alerts.alertToast('Houve um problema ao tentar buscar os serviços disponíveis!', ETypeAlertToast.danger);

      console.log(error);
    }
  }

}
