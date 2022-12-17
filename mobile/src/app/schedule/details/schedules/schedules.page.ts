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
import { AttendancesStore } from 'src/app/services/attendances/attendances.store';
import { IAttendance } from 'src/app/Interfaces/attendance/IAttendance';
import { EAttendancesStatus } from '../../enum/EAttendancesStatus';

@Component({
  selector: 'app-schedules',
  templateUrl: './schedules.page.html',
  styleUrls: ['./schedules.page.scss'],
})
export class SchedulesPage implements OnInit {
  attendances: IAttendance = null;

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
              private attendancesStore: AttendancesStore,
              public scheduleStore: SchedulesStore,
              private attendancesService: AttendancesService,
              private alerts: Alerts) {}

  public get getEAttendancesStatus(): typeof EAttendancesStatus {
    return EAttendancesStatus;
  }

  ngOnInit() {
    this.attendances = this.attendancesStore.get();

    this.job = this.jobStore.get();

    this.listSchedules = this.scheduleStore.get();

    console.log('listSchedules', [...this.listSchedules]);
  }

  setScheduleTime(dayWeek, time) {
    this.scheduleSelected = dayWeek;
    this.scheduleTimeSelected = time;
  }

  async requestCancelSchedule() {
    try {
      await this.alerts.loading();

      const response = await this.attendancesService.requestCancelAttendance({
          id: this.attendances.id,
          status: EAttendancesStatus.cancel,
          obs: 'Cliente solicitou cancelamento!'
      });

      console.log(response);

      this.navControl.navigateForward('schedule');

      this.alerts.alertToast('Atendimento cancelado com sucesso!',
                              ETypeAlertToast.success,
                              10000);

      await this.alerts.stopLoading();
    } catch (error) {
      await this.alerts.stopLoading();

      this.alerts.alertToast('Houve um problema ao tentar buscar os serviços disponíveis!', ETypeAlertToast.danger);

      console.log(error);
    }
  }

  getClassByStatus(status) {
    switch (status) {
      case EAttendancesStatus.approved:
        return 'clsApproved';
      case EAttendancesStatus.cancel:
        return 'clsCancel';
      case EAttendancesStatus.denied:
        return 'clsDenied';
      case EAttendancesStatus.waiting:
        return 'clsWaiting';
    }

    return '';
  }

}
