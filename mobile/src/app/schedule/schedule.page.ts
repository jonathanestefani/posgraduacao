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
  selector: 'app-schedule',
  templateUrl: './schedule.page.html',
  styleUrls: ['./schedule.page.scss'],
})
export class SchedulePage implements OnInit {
  listAttendances: Array<IAttendance> = [];
  isLoading: false;
  filters = {
    person_id: '',
    search: ''
  };

  constructor(private navControl: NavController,
              private attendancesService: AttendancesService,
              private attendancesStore: AttendancesStore,
              private jobStore: JobStore,
              private scheduleStore: SchedulesStore,
              private alerts: Alerts) { }

  public get getEAttendancesStatus(): typeof EAttendancesStatus {
    return EAttendancesStatus;
  }

  public ngOnInit() {
    this.filters.person_id = String(UserData.getUser().id);

    this.getListAllJobs();
  }

  public async getListAllJobs() {

    await this.alerts.loading();

    try {
      const response = await this.attendancesService.getAttendances({
        filters: { ...this.filters }
      });

      console.log(response);

      this.listAttendances = response.data;

      await this.alerts.loading();
    } catch (error) {
      await this.alerts.loading();

      this.alerts.alertToast('Houve um problema ao tentar buscar os serviços disponíveis!', ETypeAlertToast.danger);

      console.log(error);
    }
  }

  public async itemSelected(attendance) {
    console.log(attendance);

    this.attendancesStore.newModel();

    this.attendancesStore.set(attendance);

    await this.jobStore.set(attendance.job);

    this.scheduleStore.newModel();

    const schedules: IScheduleWeek = attendance.week;

    schedules.times = [attendance.times];

    console.log(schedules);

    this.scheduleStore.newModel();

    this.scheduleStore.set([schedules]);

    this.navControl.navigateForward('/schedule/details');
  }

}
