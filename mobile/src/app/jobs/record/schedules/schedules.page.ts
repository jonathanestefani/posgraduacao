import { Component, Input, OnInit, ViewChild } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { IonSlides, NavController } from '@ionic/angular';
import { IListDaysOfTheWeek } from 'src/app/Interfaces/schedule/IListDaysOfTheWeek';
import { IScheduleWeek } from 'src/app/Interfaces/schedule/IScheduleWeek';
import { Alertas } from 'src/app/providers/alertas';
import { AttendancesService } from 'src/app/services/attendances/attendances.service';
import { SchedulesService } from 'src/app/services/schedules/schedules.service';
import { IScheduleTime } from '../../../Interfaces/schedule/IScheduleTime';

@Component({
  selector: 'app-schedules',
  templateUrl: './schedules.page.html',
  styleUrls: ['./schedules.page.scss'],
})
export class SchedulesPage implements OnInit {
  @ViewChild('slide') slide: IonSlides;

  jobId = 0;

  listDaysOfTheWeekSelected: Array<IListDaysOfTheWeek> = [];
  listHoursByDaysOfTheWeek: Array<IScheduleTime> = [];

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
              private alertas: Alertas) {}

  ngOnInit() {
    this.jobId = this.activeRoute.snapshot.params.id;

    this.getWeekSchedulesById();
  }

  setListDaysOfTheWeek(event) {
    this.listDaysOfTheWeekSelected = event;
  }

  setListHoursByDaysOfTheWeek(event) {
    this.listHoursByDaysOfTheWeek = event;
  }

  async onSlideChange($event) {
    this.isBeginning = await this.slide.isBeginning();
    this.isEnd = await this.slide.isEnd();
  }

  async getWeekSchedulesById() {
    this.listDaysOfTheWeekSelected = await this.schedulesService.getDaysWeekSchedulesById(this.jobId);
  }

  async save() {
    await this.alertas.loadShow();

    try {
      console.log('listDaysOfTheWeekSelected', this.listDaysOfTheWeekSelected);

      console.log('listHoursByDaysOfTheWeek', this.listHoursByDaysOfTheWeek);

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
