import { Component, OnInit } from '@angular/core';
import { IListDaysOfTheWeek } from 'src/app/Interfaces/schedule/IListDaysOfTheWeek';
import { IScheduleWeek } from 'src/app/Interfaces/schedule/IScheduleWeek';
import { Alerts, ETypeAlertToast } from 'src/app/providers/alerts';
import { SchedulesStore } from 'src/app/services/schedules/schedules.store';

@Component({
  selector: 'app-hours-of-the-week',
  templateUrl: './hours-of-the-week.component.html',
  styleUrls: ['./hours-of-the-week.component.scss'],
})
export class HoursOfTheWeekComponent implements OnInit {
  jobId: number;

  listDaysOfTheWeek: Array<IListDaysOfTheWeek> = SchedulesStore.listDaysOfTheWeek;

  listSelected: Array<IScheduleWeek> = [];

  constructor(private scheduleStore: SchedulesStore,
              private alert: Alerts) {
    this.scheduleStore.refresh().subscribe((obj) => {
      this.listSelected = obj;
      this.jobId = this.scheduleStore.getJobId();
    });
  }

  ngOnInit(): void {}

  setItem(keyWeek: number, keyTime: number, $event) {
    this.listSelected[keyWeek].times[keyTime].time = $event.detail.value;
  }

  removeItem(keyWeek: number, keyTime: number) {
    if (this.listSelected[keyWeek].times.length === 1)
    {
      this.alert.alertToast('É necessário ter no mínimo um horário vinculado ao dia da semana!', ETypeAlertToast.danger);
      return;
    }

    this.listSelected[keyWeek].times.splice(keyTime, 1);

    this.persist();
  }

  addItem(scheduleWeekId: number, keyTime) {
    const timeModel = this.scheduleStore.getNewAppointmentScheduleTemplate();
    timeModel.schedule_week_id = scheduleWeekId;

    this.listSelected[keyTime].times.push(timeModel);
  }

  persist() {
    this.scheduleStore.set(this.listSelected);
  }

  getDayWeek(dayWeek: string) {
    const day = this.listDaysOfTheWeek.filter(elem => elem.id ===  dayWeek);

    if (day == null) {
      return 'Dia da semana não encontrado!';
    }

    return day[0].name;
  }

}
