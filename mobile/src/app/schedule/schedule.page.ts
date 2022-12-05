import { Component, OnInit } from '@angular/core';
import { NavController } from '@ionic/angular';
import { Alerts, ETypeAlertToast } from '../providers/alerts';
import { AttendancesService } from '../services/attendances/attendances.service';
import { UserData } from '../providers/userData';

@Component({
  selector: 'app-schedule',
  templateUrl: './schedule.page.html',
  styleUrls: ['./schedule.page.scss'],
})
export class SchedulePage implements OnInit {

  listAttendances: [];
  isLoading: false;
  filters = {
    person_id: ''
  };

  constructor(private navControl: NavController,
              private attendancesService: AttendancesService,
              private alerts: Alerts) { }

  ngOnInit() {
    this.filters.person_id = String(UserData.getUser().id);

    this.getListAllJobs();
  }

  async getListAllJobs() {

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

  itemSelected(job) {
    console.log(job);

    localStorage.setItem('job_details', JSON.stringify(job));

    this.navControl.navigateForward('/jobs/details');
  }

}
