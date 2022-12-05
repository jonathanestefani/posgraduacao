import { Component, OnInit } from '@angular/core';
import { IListDaysOfTheWeek } from 'src/app/Interfaces/schedule/IListDaysOfTheWeek';
import { IScheduleWeek } from 'src/app/Interfaces/schedule/IScheduleWeek';
import { SchedulesService } from 'src/app/services/schedules/schedules.service';
import { SchedulesStore } from 'src/app/services/schedules/schedules.store';

@Component({
  selector: 'app-hours-of-the-week',
  templateUrl: './hours-of-the-week.component.html',
  styleUrls: ['./hours-of-the-week.component.scss'],
})
export class HoursOfTheWeekComponent implements OnInit {
  listDaysOfTheWeek: Array<IListDaysOfTheWeek> = SchedulesService.listDaysOfTheWeek;

  listSelected: Array<IScheduleWeek> = [];

  constructor(private scheduleStore: SchedulesStore) {}

  ngOnInit() {
    this.listSelected = this.scheduleStore.get();
  }

  setItem(keyWeek: number, keyTime: number, $event) {
    this.listSelected[keyWeek].times[keyTime] = $event.details.value;
    // this.setListHoursByDaysOfTheWeek.emit(this.listHoursByDaysOfTheWeek);
  }

  removeItem(keyWeek: number, keyTime: number) {
    delete this.listSelected[keyWeek].times[keyTime];

    this.persist();
    // this.listHoursByDaysOfTheWeek = this.listHoursByDaysOfTheWeek.filter(elem => elem.id !== id);
  }

  persist() {
    this.scheduleStore.set(this.listSelected);
  }

  getDayWeek(day_week: string) {
    const day = this.listDaysOfTheWeek.filter(elem => elem.id ===  day_week);

    if (day == null) {
      return 'Dia da semana não encontrado!';
    }

    return day[0].name;
  }

}
