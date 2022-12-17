import { Component, OnInit, ViewChild } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { IonTabs, NavController } from '@ionic/angular';
import { IJob } from 'src/app/Interfaces/job/interface/IJob';
import { JobStore } from 'src/app/services/jobs/job.store';
import { AboutPage } from './about/about.page';
import { SchedulesPage } from './schedules/schedules.page';

@Component({
  selector: 'app-record',
  templateUrl: './record.page.html',
  styleUrls: ['./record.page.scss'],
})
export class RecordPage implements OnInit {
  @ViewChild('myTabs') tabRef: IonTabs;

  job: IJob;
  jobId: number = 0;

  tabAbout: any;
  tabSchedule: any;

  constructor(
    private activeRoute: ActivatedRoute,
    private navControl: NavController,
    private jobStore: JobStore,
    public router: Router
  ) {
    this.tabAbout = AboutPage;
    this.tabSchedule = SchedulesPage;

    if (this.activeRoute.snapshot.children[0].params.id == null) {
      this.jobStore.newModel();
    }

    this.jobStore.refresh().subscribe(() => {
      this.job = this.jobStore.get();

      this.jobId = this.job.id;
    });
  }

  ionViewDidEnter() {
    this.jobId = this.activeRoute.snapshot.children[0].params.id;

    console.log('ngOnInit', this.activeRoute.snapshot.children[0].params.id);
  }

  ngOnInit() {}

  accessTab(tab) {
    console.log(tab, this.jobId);

    if (this.jobId > 0) {
      this.navControl.navigateForward('/jobs/record/' + tab + '/' + this.jobId);
    } else {
      this.navControl.navigateForward('/jobs/record/' + tab);
    }
  }

}
