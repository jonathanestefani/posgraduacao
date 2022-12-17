import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { NavController } from '@ionic/angular';
import { IJob } from 'src/app/Interfaces/job/interface/IJob';
import { Alerts, ETypeAlertToast } from 'src/app/providers/alerts';
import { AttendancesService } from 'src/app/services/attendances/attendances.service';
import { UserData } from 'src/app/providers/userData';
import { JobStore } from 'src/app/services/jobs/job.store';
import { IScheduleWeek } from 'src/app/Interfaces/schedule/IScheduleWeek';
import { IScheduleTime } from 'src/app/Interfaces/schedule/IScheduleTime';
import { SchedulesStore } from 'src/app/services/schedules/schedules.store';

@Component({
  selector: 'app-schedules',
  templateUrl: './schedules.page.html',
  styleUrls: ['./schedules.page.scss'],
})
export class SchedulesPage implements OnInit {
  filters: any = {
    job_id: 0
  };

  job: IJob = JobStore.job;

  listSchedules: Array<IScheduleWeek> = [];
  scheduleSelected: IScheduleWeek = {};
  scheduleTimeSelected: IScheduleTime = {};

  constructor(private navControl: NavController,
              public router: Router,
              private jobStore: JobStore,
              public scheduleStore: SchedulesStore,
              private attendancesService: AttendancesService,
              private alerts: Alerts) {}

  ngOnInit() {
      this.job = this.jobStore.get();
      this.listSchedules = this.scheduleStore.get();
  }

  setScheduleTime(dayWeek, time) {
    this.scheduleSelected = dayWeek;
    this.scheduleTimeSelected = time;
  }

  validTime(): boolean {
    if (!this.scheduleTimeSelected.id) {
      this.alerts.alertToast('Favor selecionar um horário!', ETypeAlertToast.danger);

      return false;
    }

    if (!this.scheduleSelected.id) {
      this.alerts.alertToast('Favor selecionar um dia da semana!', ETypeAlertToast.danger);

      return false;
    }

    return true;
  }

  async requestSchedule() {
    if (!this.validTime()) {
      return;
    }

    try {
      await this.alerts.loading();

      const response = await this.attendancesService.requestAttendance({
          id: 0,
          person_id: (UserData.getUser()).id,
          job_id: this.job.id,
          schedule_week_id: this.scheduleSelected.id,
          schedule_time_id: this.scheduleTimeSelected.id,
          status: 1
      });

      console.log(response);

      this.navControl.navigateForward('jobs');

      this.alerts.alertToast('Atendimento solicitado.<br />Favor aguardar a confirmação através do menu na opção "Minha Agenda"!',
                              ETypeAlertToast.success,
                              10000);

      await this.alerts.stopLoading();
    } catch (error) {
      await this.alerts.stopLoading();

      this.alerts.alertToast('Houve um problema ao tentar buscar os serviços disponíveis!', ETypeAlertToast.danger);

      console.log(error);
    }
  }

}
