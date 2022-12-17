import { Component, OnInit, ViewChild } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { IonSlides, NavController } from '@ionic/angular';
import { IJob } from 'src/app/Interfaces/job/interface/IJob';
import { IScheduleWeek } from 'src/app/Interfaces/schedule/IScheduleWeek';
import { Alerts, ETypeAlertToast } from 'src/app/providers/alerts';
import { JobStore } from 'src/app/services/jobs/job.store';
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

  job: IJob = JobStore.job;

  listDaysOfTheWeekSelected: Array<IScheduleWeek> = [];
  listHoursByDaysOfTheWeek: Array<IScheduleTime> = [];

  isBeginning = true;
  isEnd = false;

  slideOpts = {
    initialSlide: 0,
    speed: 400
  };

  constructor(public router: Router,
              private schedulesService: SchedulesService,
              private jobStore: JobStore,
              private scheduleStore: SchedulesStore,
              private navControl: NavController,
              private alerts: Alerts) {}

  ngOnInit() {
    this.scheduleStore.newModel();

    // this.tabRef.select('about');
    this.job = this.jobStore.get();

    this.loadScheduleById();

    this.slideOpts.initialSlide = 0;
  }

  loadScheduleById() {
    //if (Number(this.activeRoute.snapshot.params.id) > 0) {
      this.getWeekSchedulesByJobId(this.job.id);
    // }
  }

  async getWeekSchedulesByJobId(jobId: number) {
    await this.alerts.loading();

    const result = await this.schedulesService.getDaysWeekSchedulesByJobId(jobId);

    console.log(result);

    this.scheduleStore.setJobId(jobId);

    this.scheduleStore.set(result);

    await this.alerts.stopLoading();
  }

  async onSlideChange() {
    this.isBeginning = await this.slide.isBeginning();
    this.isEnd = await this.slide.isEnd();
  }

  validDayOfWeek(): boolean {
    const schedules = this.scheduleStore.get();

    if (schedules.length === 0) {
      this.alerts.alertToast('Favor selecionar um dia da semana!', ETypeAlertToast.danger);

      return false;
    }

    return true;
  }

  async save() {
    try {
      if (!this.validDayOfWeek()) {
        return;
      }

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
