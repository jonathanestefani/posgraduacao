import { Component, OnInit } from '@angular/core';
import { IListDaysOfTheWeek } from 'src/app/Interfaces/schedule/IListDaysOfTheWeek';
import { IScheduleTime } from 'src/app/Interfaces/schedule/IScheduleTime';
import { IScheduleWeek } from 'src/app/Interfaces/schedule/IScheduleWeek';
import { Alerts } from 'src/app/providers/alerts';
import { SchedulesStore } from 'src/app/services/schedules/schedules.store';

@Component({
  selector: 'app-days-of-week',
  templateUrl: './days-of-week.component.html',
  styleUrls: ['./days-of-week.component.scss'],
})
export class DaysOfWeekComponent implements OnInit {
  jobId: number;

  listDaysOfTheWeek: Array<IListDaysOfTheWeek> = SchedulesStore.listDaysOfTheWeek;
  listSelected: Array<IScheduleWeek> = [];
  listHoursByStandardDaysOfTheWeek: Array<IScheduleTime> = [
    { id: 0, time: '08:00' },
    { id: 0, time: '12:00' },
    { id: 0, time: '13:30' },
    { id: 0, time: '18:00' }
  ];

  constructor(private scheduleStore: SchedulesStore,
              private alerts: Alerts) {}

  ngOnInit() {
    this.scheduleStore.refresh().subscribe((obj) => {
      this.listSelected = this.scheduleStore.get();
      this.jobId = this.scheduleStore.getJobId();

      console.log('listSelected');
      console.log(this.listSelected);

      console.log('obj', obj);
    });
  }

  checkTheDayInTheSchedule(dayWeek: string) {
    return this.listSelected.filter(elem => elem.day_week === dayWeek).length > 0;
  }

  setItem($event) {
    console.log('setItem', $event);

    const id = $event.detail.value;

    if ($event.detail.checked) {
      const item = this.getItemByDay(id);

      if (item.length <= 0) {
        const data = this.listDaysOfTheWeek.filter(elem => elem.id ===  id)[0];

        const form: IScheduleWeek = {
          id: 0,
          job_id: this.scheduleStore.getJobId(),
          day_week: data.id,
          times: this.getNewAppointmentScheduleTemplate()
        };

        this.listSelected.push( form );

        this.persist();
      }
    } else {
      const item = this.listSelected.filter(elem => elem.day_week === id);

      if (item.length > 0) {
        this.listSelected = this.listSelected.filter(elem => elem.day_week !== id);

        this.persist();
      }
    }
  }

  getItemByDay(dayWeek: string) {
    return this.listSelected.filter(elem => elem.day_week === dayWeek);
  }

  persist() {
    // this.scheduleStore.newModel();

    this.scheduleStore.set(this.listSelected);
  }

  getNewAppointmentScheduleTemplate(): Array<IScheduleTime> {
    const arrTimes: Array<IScheduleTime> = [];

    for (const hours of this.listHoursByStandardDaysOfTheWeek) {
      const timeModel = this.scheduleStore.getNewAppointmentScheduleTemplate();
      timeModel.time = hours.time;

      arrTimes.push(timeModel);
    }

    return arrTimes;
  }
}
