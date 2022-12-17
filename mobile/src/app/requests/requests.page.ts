import { Component, OnInit } from '@angular/core';
import { NavController } from '@ionic/angular';
import { Alerts, ETypeAlertToast } from '../providers/alerts';
import { AttendancesService } from '../services/attendances/attendances.service';
import { UserData } from '../providers/userData';
import { IAttendance } from '../Interfaces/attendance/IAttendance';
import { EAttendancesStatus } from './enum/EAttendancesStatus';
import { JobStore } from '../services/jobs/job.store';
import { SchedulesStore } from '../services/schedules/schedules.store';
import { IScheduleWeek } from '../Interfaces/schedule/IScheduleWeek';
import { AttendancesStore } from '../services/attendances/attendances.store';

@Component({
  selector: 'app-requests',
  templateUrl: './requests.page.html',
  styleUrls: ['./requests.page.scss'],
})
export class RequestsPage implements OnInit {
  listAttendances: Array<IAttendance> = [];
  isLoading: false;
  filters = {
    requests_by_person_id: '',
    search: ''
  };

  constructor(private navControl: NavController,
              private attendancesService: AttendancesService,
              private attendancesStore: AttendancesStore,
              private jobStore: JobStore,
              private requestsStore: SchedulesStore,
              private alerts: Alerts) { }

  public get getEAttendancesStatus(): typeof EAttendancesStatus {
    return EAttendancesStatus;
  }

  public ngOnInit() {
    this.filters.requests_by_person_id = String(UserData.getUser().id);

    this.listAttendances = [];

    this.getListAllJobs();
  }

  doRefresh(event) {
    setTimeout(() => {
      event.target.complete();
      this.ngOnInit();
    }, 1000);
  }

  public async getListAllJobs() {

    await this.alerts.loading();

    try {
      const response = await this.attendancesService.getAttendances({
        filters: { ...this.filters },
        all: true
      });

      console.log(response);

      this.listAttendances = response || [];

      await this.alerts.loading();
    } catch (error) {
      await this.alerts.loading();

      this.alerts.alertToast('Houve um problema ao tentar buscar as solicitações!', ETypeAlertToast.danger);

      console.log(error);
    }
  }

  public async itemSelected(attendance) {
    console.log(attendance);

    this.attendancesStore.newModel();

    this.attendancesStore.set(attendance);

    await this.jobStore.set(attendance.job);

    this.requestsStore.newModel();

    const schedules: IScheduleWeek = attendance.week;

    schedules.times = [attendance.times];

    this.requestsStore.newModel();

    this.requestsStore.set([schedules]);

    this.navControl.navigateForward('/requests/details');
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
