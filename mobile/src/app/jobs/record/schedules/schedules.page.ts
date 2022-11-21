import { Component, Input, OnInit, ViewChild } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { IonSlides, NavController } from '@ionic/angular';
import { Alertas } from 'src/app/providers/alertas';
import { AttendancesService } from 'src/app/services/attendances/attendances.service';
import { SchedulesService } from 'src/app/services/schedules/schedules.service';

@Component({
  selector: 'app-schedules',
  templateUrl: './schedules.page.html',
  styleUrls: ['./schedules.page.scss'],
})
export class SchedulesPage implements OnInit {
  @ViewChild('slide') slide: IonSlides;

  job_id: number = 0;

  listDaysOfTheWeekSelected = [];

  isBeginning = true;
  isEnd = false;

  slideOpts = {
    initialSlide: 0,
    speed: 400
  };

  constructor(private navControl: NavController,
              public router: Router,
              private activeRoute: ActivatedRoute,
              private schedulesService: SchedulesService,
              private attendancesService: AttendancesService,
              private alertas: Alertas) {
   }

  ngOnInit() {
    this.job_id = this.activeRoute.snapshot.params.id;

    this.getSchedulesById();
  }

  setListDaysOfTheWeek(event) {
    this.listDaysOfTheWeekSelected = event;
  }

  async onSlideChange($event) {
    this.isBeginning = await this.slide.isBeginning();
    this.isEnd = await this.slide.isEnd();
  }

  getSchedulesById() {
    this.schedulesService.getSchedules({
      job_id: this.job_id
    });
  }

  async save() {
    await this.alertas.loadShow();

    try {
      /*
      const response = await this.attendancesService.getJobs({
        this.form
      });
      */

      // console.log(response);

      // this.listJobs = response.data;

      await this.alertas.loadStop();
    } catch (error) {
      await this.alertas.loadStop();

      this.alertas.toastShow('Houve um problema ao tentar buscar os serviços disponíveis!', 'E');

      console.log(error);
    }
  }

}
