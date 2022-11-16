import { Component, Input, OnInit, ViewChild } from '@angular/core';
import { Router } from '@angular/router';
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

  listDaysOfTheWeekSelected = [];

  isBeginning = true;
  isEnd = false;

  slideOpts = {
    initialSlide: 0,
    speed: 400
  };

  constructor(private navControl: NavController,
              public router: Router,
              private schedulesService: SchedulesService,
              private attendancesService: AttendancesService,
              private alertas: Alertas) {
   }

  ngOnInit() {}

  setListDaysOfTheWeek(event) {
    this.listDaysOfTheWeekSelected = event;
  }

  async onSlideChange($event) {
    this.isBeginning = await this.slide.isBeginning();
    this.isEnd = await this.slide.isEnd();
  }

}
