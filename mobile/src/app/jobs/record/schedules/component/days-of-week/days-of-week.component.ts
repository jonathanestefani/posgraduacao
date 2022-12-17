import { Component, OnInit } from '@angular/core';
import { IListDaysOfTheWeek } from 'src/app/Interfaces/schedule/IListDaysOfTheWeek';
import { IScheduleTime } from 'src/app/Interfaces/schedule/IScheduleTime';
import { IScheduleWeek } from 'src/app/Interfaces/schedule/IScheduleWeek';
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

  constructor(private scheduleStore: SchedulesStore) {}

  ngOnInit() {
    this.scheduleStore.refresh().subscribe((obj) => {
      this.listSelected = obj;
      this.jobId = this.scheduleStore.getJobId();
    });

    this.listSelected = this.scheduleStore.get();
  }

  checkTheDayInTheSchedule(dayWeek: string) {
    return this.listSelected.filter(elem => elem.day_week === dayWeek).length > 0;
  }

  setItem($event) {
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
