import { Component, OnInit, ViewChild } from '@angular/core';
import { Router } from '@angular/router';
import { IonTabs } from '@ionic/angular';
import { IJob } from 'src/app/Interfaces/job/interface/IJob';
import { JobStore } from 'src/app/services/jobs/job.store';
import { JobsService } from 'src/app/services/jobs/jobs.service';
import { AboutPage } from './about/about.page';
import { SchedulesPage } from './schedules/schedules.page';

@Component({
  selector: 'app-details',
  templateUrl: './details.page.html',
  styleUrls: ['./details.page.scss'],
})
export class DetailsPage implements OnInit {
  @ViewChild('myTabs') tabRef: IonTabs;

  job: IJob;

  tabAbout: any;
  tabSchedule: any;

  constructor(public router: Router,
              private jobStore: JobStore) {

    // this.job = JSON.parse(localStorage.getItem('job_details'));
    this.job = this.jobStore.get();

    this.tabAbout = AboutPage;
    this.tabSchedule = SchedulesPage;

  }

  ionViewDidEnter() {
    this.tabRef.select('about');
  }

  ngOnInit() {}

}
