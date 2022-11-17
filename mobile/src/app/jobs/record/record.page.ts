import { Component, OnInit, ViewChild } from '@angular/core';
import { Router } from '@angular/router';
import { IonTabs, NavController } from '@ionic/angular';
import { AboutPage } from './about/about.page';
import { SchedulesPage } from './schedules/schedules.page';

@Component({
  selector: 'app-record',
  templateUrl: './record.page.html',
  styleUrls: ['./record.page.scss'],
})
export class RecordPage implements OnInit {
  @ViewChild('myTabs') tabRef: IonTabs;

  job = {
    id: 0,
    name: '',
    status: 1
  };

  tabAbout: any;
  tabSchedule: any;

  constructor(private navControl: NavController,
              public router: Router) {

    this.job = JSON.parse(localStorage.getItem('job_details'));

    this.tabAbout = AboutPage;
    this.tabSchedule = SchedulesPage;
  }

  ionViewDidEnter() {
    this.tabRef.select('schedules');
  }

  ngOnInit() {}

}
