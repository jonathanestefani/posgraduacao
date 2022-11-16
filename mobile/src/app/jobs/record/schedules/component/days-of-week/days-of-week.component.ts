import { Component, EventEmitter, OnInit, Output } from '@angular/core';
import { SchedulesService } from 'src/app/services/schedules/schedules.service';

@Component({
  selector: 'app-days-of-week',
  templateUrl: './days-of-week.component.html',
  styleUrls: ['./days-of-week.component.scss'],
})
export class DaysOfWeekComponent implements OnInit {
  @Output() public listDaysOfTheWeekSelected = new EventEmitter();

  listDaysOfTheWeek = SchedulesService.listDaysOfTheWeek;

  listSelected = [];

  constructor() { }

  ngOnInit() {}

  setItem($event) {
    const id = Number($event.detail.value);

    if ($event.detail.checked) {
      const data = this.listDaysOfTheWeek.filter(elem => elem.id ===  id)[0];

      this.listSelected.push( data );
    } else {
      this.listSelected = this.listSelected.filter(elem => elem.id !== id);
    }

    this.listDaysOfTheWeekSelected.emit(this.listSelected);
  }
}
