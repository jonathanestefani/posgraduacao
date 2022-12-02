import { Component, EventEmitter, Input, OnInit, Output } from '@angular/core';
import { IListDaysOfTheWeek } from 'src/app/Interfaces/schedule/IListDaysOfTheWeek';
import { IScheduleTime } from 'src/app/Interfaces/schedule/IScheduleTime';
import { IScheduleWeek } from 'src/app/Interfaces/schedule/IScheduleWeek';

@Component({
  selector: 'app-hours-of-the-week',
  templateUrl: './hours-of-the-week.component.html',
  styleUrls: ['./hours-of-the-week.component.scss'],
})
export class HoursOfTheWeekComponent implements OnInit {
  @Input() public listDaysOfTheWeekSelected: Array<IListDaysOfTheWeek> = [];
  @Output() public setListHoursByDaysOfTheWeek = new EventEmitter();

  listHoursByStandardDaysOfTheWeek: Array<IScheduleTime> = [
    { id: 0, time: '08:00' },
    { id: 0, time: '12:00' },
    { id: 0, time: '13:30' },
    { id: 0, time: '18:00' }
  ];

  listHoursByDaysOfTheWeek: Array<IScheduleTime> = this.listHoursByStandardDaysOfTheWeek;

  constructor() {}

  ngOnInit() {
    this.setItem();
  }

  setItem() {
    this.setListHoursByDaysOfTheWeek.emit(this.listHoursByDaysOfTheWeek);
  }

  removeItem(id) {
    this.listHoursByDaysOfTheWeek = this.listHoursByDaysOfTheWeek.filter(elem => elem.id !== id);
  }

}
