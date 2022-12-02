import { Component, EventEmitter, Input, OnInit, Output } from '@angular/core';
import { IListDaysOfTheWeek } from 'src/app/Interfaces/schedule/IListDaysOfTheWeek';
import { IScheduleWeek } from 'src/app/Interfaces/schedule/IScheduleWeek';
import { SchedulesService } from 'src/app/services/schedules/schedules.service';

@Component({
  selector: 'app-days-of-week',
  templateUrl: './days-of-week.component.html',
  styleUrls: ['./days-of-week.component.scss'],
})
export class DaysOfWeekComponent implements OnInit {
  @Input() public jobId: number;
  @Output() public listDaysOfTheWeekSelected = new EventEmitter();

  listDaysOfTheWeek: Array<IListDaysOfTheWeek> = SchedulesService.listDaysOfTheWeek;
  listSelected: Array<IScheduleWeek> = [];

  constructor() { }

  ngOnInit() {}

  checkTheDayInTheSchedule(day_week: string) {
    return this.listDaysOfTheWeek.filter(elem => elem.id ===  day_week).length > 0;
  }

  setItem($event) {
    const id = $event.detail.value;

    if ($event.detail.checked) {
      const data = this.listDaysOfTheWeek.filter(elem => elem.id ===  id)[0];

      const form: IScheduleWeek = {
        id: 0,
        job_id: this.jobId > 0 ? this.jobId : 0,
        day_week: data.id,
        times: [],
      };

      this.listSelected.push( form );
    } else {
      this.listSelected = this.listSelected.filter(elem => elem.id !== id);
    }

    this.listDaysOfTheWeekSelected.emit(this.listSelected);
  }
}
