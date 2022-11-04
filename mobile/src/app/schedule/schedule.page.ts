import { Component, OnInit } from '@angular/core';
import { NavController } from '@ionic/angular';
import { Alertas } from '../providers/alertas';
import { AttendancesService } from '../services/attendances/attendances.service';
import { SchedulesService } from '../services/schedules/schedules.service';
import { UserData } from '../services/UserData';

@Component({
  selector: 'app-schedule',
  templateUrl: './schedule.page.html',
  styleUrls: ['./schedule.page.scss'],
})
export class SchedulePage implements OnInit {

  listAttendances: [];
  isLoading: false;
  filters = {
    person_id: ""
  }

  constructor(private navControl: NavController,
              private attendancesService: AttendancesService,
              private alertas: Alertas) { }

  ngOnInit() {
    this.filters.person_id = UserData.getUser().id;

    this.getListAllJobs();
  }

  async getListAllJobs() {

    await this.alertas.loadShow();

    try {
      const response = await this.attendancesService.getAttendances({
        filters: { ...this.filters }
      });   

      console.log(response);

      this.listAttendances = response.data;

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
