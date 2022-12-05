import { Component, EventEmitter, Input, OnInit, Output } from '@angular/core';
import { IListDaysOfTheWeek } from 'src/app/Interfaces/schedule/IListDaysOfTheWeek';
import { IScheduleTime } from 'src/app/Interfaces/schedule/IScheduleTime';
import { IScheduleWeek } from 'src/app/Interfaces/schedule/IScheduleWeek';
import { Alerts, ETypeAlert } from 'src/app/providers/alerts';
import { SchedulesService } from 'src/app/services/schedules/schedules.service';
import { SchedulesStore } from 'src/app/services/schedules/schedules.store';

@Component({
  selector: 'app-days-of-week',
  templateUrl: './days-of-week.component.html',
  styleUrls: ['./days-of-week.component.scss'],
})
export class DaysOfWeekComponent implements OnInit {
  jobId: number;

  listDaysOfTheWeek: Array<IListDaysOfTheWeek> = SchedulesService.listDaysOfTheWeek;
  listSelected: Array<IScheduleWeek> = [];
  listHoursByStandardDaysOfTheWeek: Array<IScheduleTime> = [
    { id: 0, time: '08:00' },
    { id: 0, time: '12:00' },
    { id: 0, time: '13:30' },
    { id: 0, time: '18:00' }
  ];

  constructor(private scheduleStore: SchedulesStore,
              private alerts: Alerts) { }

  ngOnInit() {
    this.listSelected = this.scheduleStore.get();

    this.jobId = this.scheduleStore.getJobId();
  }

  checkTheDayInTheSchedule(day_week: string) {
    return this.listSelected.filter(elem => elem.day_week ===  day_week).length > 0;
  }

  setItem($event) {
    const id = $event.detail.value;

    if ($event.detail.checked) {
      const data = this.listDaysOfTheWeek.filter(elem => elem.id ===  id)[0];

      const form: IScheduleWeek = {
        id: 0,
        job_id: this.scheduleStore.getJobId(),
        day_week: data.id,
        times: this.getNewAppointmentScheduleTemplate()
      };

      this.listSelected.push( form );
    } else {
      this.alerts.alert('Atenção', 'Deseja mesmo remover?', ETypeAlert.confirm).then(() => {
        this.listSelected = this.listSelected.filter(elem => elem.day_week !== id);
      });
    }

    this.persist();
  }

  persist() {
    this.scheduleStore.set(this.listSelected);
  }

  getNewAppointmentScheduleTemplate(): Array<IScheduleTime> {
    const arrTimes: Array<IScheduleTime> = [];

    for (const time of this.listHoursByStandardDaysOfTheWeek) {
      arrTimes.push({
        id: 0,
        job_id: this.jobId,
        schedule_week_id: 0,
        time: time.time
      });
    }

    return arrTimes;
  }
}
