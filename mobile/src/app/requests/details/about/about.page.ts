import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { NavController } from '@ionic/angular';
import { IJob } from 'src/app/Interfaces/job/interface/IJob';
import { JobStore } from 'src/app/services/jobs/job.store';

@Component({
  selector: 'app-about',
  templateUrl: './about.page.html',
  styleUrls: ['./about.page.scss'],
})
export class AboutPage implements OnInit {

  job: IJob = JobStore.job;

  constructor(private navControl: NavController,
              public router: Router,
              private jobStore: JobStore) {
   }

  ngOnInit() {
    this.job = this.jobStore.get();
  }

}
