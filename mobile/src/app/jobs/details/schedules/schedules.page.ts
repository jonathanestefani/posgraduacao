import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { NavController } from '@ionic/angular';
import { IJob } from 'src/app/Interfaces/job/interface/IJob';
import { Alerts, ETypeAlertToast } from 'src/app/providers/alerts';
import { AttendancesService } from 'src/app/services/attendances/attendances.service';
import { JobsService } from 'src/app/services/jobs/jobs.service';
import { SchedulesService } from 'src/app/services/schedules/schedules.service';
import { UserData } from 'src/app/providers/userData';
import { JobStore } from 'src/app/services/jobs/job.store';
import { IScheduleWeek } from 'src/app/Interfaces/schedule/IScheduleWeek';

@Component({
  selector: 'app-schedules',
  templateUrl: './schedules.page.html',
  styleUrls: ['./schedules.page.scss'],
})
export class SchedulesPage implements OnInit {

  filters: any = {
    date: '2022-10-05',
    job_id: 0
  };

  job: IJob = JobsService.job;

  listSchedules: Array<IScheduleWeek> = [];
  scheduleSelected: any = {};

  constructor(private navControl: NavController,
              public router: Router,
              private schedulesService: SchedulesService,
              private jobStore: JobStore,
              private attendancesService: AttendancesService,
              private alerts: Alerts) {

    // this.job = JSON.parse(localStorage.getItem('job_details'));

    this.getListAllSchedules();
   }

  ngOnInit() {
    this.job = this.jobStore.get();
  }

  setSchedule(item) {
    this.scheduleSelected = item;
  }

  async getListAllSchedules() {

    await this.alerts.loading();

    try {
      this.listSchedules = [];

      const response = await this.schedulesService.getDaysWeekSchedulesByJobId(this.job.id);

      console.log(response);

      this.listSchedules = response;

      await this.alerts.loading();
    } catch (error) {
      await this.alerts.loading();

      this.alerts.alertToast('Houve um problema ao tentar buscar os serviços disponíveis!', ETypeAlertToast.danger);

      console.log(error);
    }
  }

  async requestSchedule() {
    await this.alerts.loading();

    try {
      const response = await this.attendancesService.requestAttendance({
          id: 0,
          person_id: (UserData.getUser()).id,
          job_id: this.job.id,
          schedule_id: this.scheduleSelected.id,
          status: 1
      });

      console.log(response);

      this.alerts.alertToast('Solicitação enviada com sucesso!');

      await this.alerts.loading();
    } catch (error) {
      await this.alerts.loading();

      this.alerts.alertToast('Houve um problema ao tentar buscar os serviços disponíveis!', ETypeAlertToast.danger);

      console.log(error);
    }
  }

}
