import { Component, OnInit, ViewChild } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
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

  job_id: number = 0;

  tabAbout: any;
  tabSchedule: any;

  constructor(private activeRoute: ActivatedRoute,
              private navControl: NavController,
              public router: Router) {

    //= JSON.parse(localStorage.getItem('job_details'));

    this.tabAbout = AboutPage;
    this.tabSchedule = SchedulesPage;
  }

  ionViewDidEnter() {
    // this.tabRef.select('about');
  }

  ngOnInit() {
    this.job_id = this.activeRoute.snapshot.children[0].params.id;

    console.log('ngOnInit', this.activeRoute.snapshot.children[0].params.id);
  }

  accessTab(tab) {
    console.log(tab, this.job_id);

    if (this.job_id > 0) {
      this.navControl.navigateForward('/jobs/record/' + tab + '/' + this.job_id);
    } else {
      this.navControl.navigateForward('/jobs/record/' + tab);
    }
  }

}
