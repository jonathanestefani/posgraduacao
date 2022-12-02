import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { NavController } from '@ionic/angular';
import { IJob } from 'src/app/Interfaces/job/interface/IJob';
import { Alertas } from 'src/app/providers/alertas';
import { AttendancesService } from 'src/app/services/attendances/attendances.service';
import { JobsService } from 'src/app/services/jobs/jobs.service';
import { SchedulesService } from 'src/app/services/schedules/schedules.service';
import { UserData } from 'src/app/services/UserData';

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

  listSchedules = [];
  scheduleSelected: any = {};

  constructor(private navControl: NavController,
              public router: Router,
              private schedulesService: SchedulesService,
              private attendancesService: AttendancesService,
              private alertas: Alertas) {

    this.job = JSON.parse(localStorage.getItem('job_details'));

    console.log(this.job);

    this.getListAllSchedules();
   }

  ngOnInit() {
  }

  setSchedule(item) {
    this.scheduleSelected = item;
  }

  async getListAllSchedules() {

    await this.alertas.loadShow();

    try {
      this.listSchedules = [];

      const response = await this.schedulesService.getDaysWeekSchedulesById(this.job.id);

      console.log(response);

      this.listSchedules = response;

      await this.alertas.loadStop();
    } catch (error) {
      await this.alertas.loadStop();

      this.alertas.toastShow('Houve um problema ao tentar buscar os serviços disponíveis!', 'E');

      console.log(error);
    }
  }

  async requestSchedule() {
    await this.alertas.loadShow();

    try {
      const response = await this.attendancesService.requestAttendance({
          person_id: UserData.getUser().id,
          job_id: this.job.id,
          schedule_id: this.scheduleSelected.id,
          status: 1
      });

      console.log(response);

      this.alertas.toastShow('Solicitação enviada com sucesso!');

      await this.alertas.loadStop();
    } catch (error) {
      await this.alertas.loadStop();

      this.alertas.toastShow('Houve um problema ao tentar buscar os serviços disponíveis!', 'E');

      console.log(error);
    }
  }

}
