import { Component, Input, OnInit } from '@angular/core';

@Component({
  selector: 'app-hours-of-the-week',
  templateUrl: './hours-of-the-week.component.html',
  styleUrls: ['./hours-of-the-week.component.scss'],
})
export class HoursOfTheWeekComponent implements OnInit {
  @Input() public listDaysOfTheWeekSelected: Array<any> = [];

  constructor() {}

  ngOnInit() {}

  setItem(event) {
    console.log(event);
  }
}
