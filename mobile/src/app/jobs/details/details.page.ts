import { Component, OnInit, ViewChild } from '@angular/core';
import { Router } from '@angular/router';
import { IonTabs, NavController } from '@ionic/angular';
import { Alertas } from 'src/app/providers/alertas';
import { SchedulesService } from 'src/app/services/schedules/schedules.service';
import { AboutPage } from './about/about.page';
import { SchedulesPage } from './schedules/schedules.page';

@Component({
  selector: 'app-details',
  templateUrl: './details.page.html',
  styleUrls: ['./details.page.scss'],
})
export class DetailsPage implements OnInit {
  @ViewChild('myTabs') tabRef: IonTabs;

  job = {};

  tabAbout: any;
  tabSchedule: any;

  constructor(private navControl: NavController,
              public router: Router) {

    this.job = JSON.parse(localStorage.getItem('job_details'));

    this.tabAbout = AboutPage;
    this.tabSchedule = SchedulesPage;

  }

  ionViewDidEnter() {
    this.tabRef.select('about');
  }

  ngOnInit() {}

}
