import { Component, OnInit, ViewChild } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { IonSlides } from '@ionic/angular';
import { IScheduleWeek } from 'src/app/Interfaces/schedule/IScheduleWeek';
import { Alerts, ETypeAlertToast } from 'src/app/providers/alerts';
import { SchedulesService } from 'src/app/services/schedules/schedules.service';
import { SchedulesStore } from 'src/app/services/schedules/schedules.store';
import { IScheduleTime } from '../../../Interfaces/schedule/IScheduleTime';

@Component({
  selector: 'app-schedules',
  templateUrl: './schedules.page.html',
  styleUrls: ['./schedules.page.scss'],
})
export class SchedulesPage implements OnInit {
  @ViewChild('slide') slide: IonSlides;

  scheduleWeekId = 0;

  listDaysOfTheWeekSelected: Array<IScheduleWeek> = [];
  listHoursByDaysOfTheWeek: Array<IScheduleTime> = [];

  isBeginning = true;
  isEnd = false;

  slideOpts = {
    initialSlide: 0,
    speed: 400
  };

  constructor(public router: Router,
              private activeRoute: ActivatedRoute,
              private schedulesService: SchedulesService,
              private scheduleStore: SchedulesStore,
              private alerts: Alerts) {}

  ngOnInit() {
    this.loadScheduleById();
  }

  loadScheduleById() {
    if (Number(this.activeRoute.snapshot.params.id) > 0) {
      this.getWeekSchedulesByJobId(this.activeRoute.snapshot.params.id);
    } else {
      this.scheduleStore.newModel();
    }
  }

  async getWeekSchedulesByJobId(jobId: number) {
    this.scheduleStore.set(await this.schedulesService.getDaysWeekSchedulesByJobId(jobId));

    this.scheduleStore.setJobId(jobId);
  }

  async onSlideChange($event) {
    this.isBeginning = await this.slide.isBeginning();
    this.isEnd = await this.slide.isEnd();
  }

  async save() {
    // await this.alerts.loading();

    try {
      console.log('listDaysOfTheWeekSelected', this.scheduleStore.get());

      const response = await this.schedulesService.requestWeekSchedule(this.scheduleStore.get());

      console.log(response);

      await this.alerts.loading();
    } catch (error) {
      await this.alerts.loading();

      this.alerts.alertToast('Houve um problema ao tentar buscar os serviços disponíveis!', ETypeAlertToast.danger);

      console.log(error);
    }
  }

}
