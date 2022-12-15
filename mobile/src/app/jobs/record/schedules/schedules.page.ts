import { Component, OnInit, ViewChild } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { IonSlides, NavController } from '@ionic/angular';
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
              private navControl: NavController,
              private alerts: Alerts) {}

  ngOnInit() {
    this.scheduleStore.newModel();

    this.loadScheduleById();
  }

  loadScheduleById() {
    if (Number(this.activeRoute.snapshot.params.id) > 0) {
      this.getWeekSchedulesByJobId(this.activeRoute.snapshot.params.id);
    }
  }

  async getWeekSchedulesByJobId(jobId: number) {
    await this.alerts.loading();

    const result = await this.schedulesService.getDaysWeekSchedulesByJobId(jobId);

    this.scheduleStore.set(result);

    this.scheduleStore.setJobId(jobId);

    await this.alerts.stopLoading();
  }

  async onSlideChange() {
    this.isBeginning = await this.slide.isBeginning();
    this.isEnd = await this.slide.isEnd();
  }

  async save() {
    try {
      const jobId = this.scheduleStore.getJobId();

      let postData = {
        job_id: jobId,
        items: this.scheduleStore.get()
      };

      const response = await this.schedulesService.requestWeekSchedule({ ...postData });

      this.navControl.navigateForward('jobs');

      this.alerts.alertToast('Atendimento salvo com sucesso!');

      await this.alerts.stopLoading();
    } catch (error) {
      await this.alerts.stopLoading();

      this.alerts.alertToast('Houve um problema interno ao tentar salvar!', ETypeAlertToast.danger);

      console.log(error);
    }
  }

}
