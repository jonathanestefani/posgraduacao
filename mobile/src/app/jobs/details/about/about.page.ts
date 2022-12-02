import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { NavController } from '@ionic/angular';
import { IJob } from 'src/app/Interfaces/job/interface/IJob';
import { JobsService } from 'src/app/services/jobs/jobs.service';

@Component({
  selector: 'app-about',
  templateUrl: './about.page.html',
  styleUrls: ['./about.page.scss'],
})
export class AboutPage implements OnInit {

  job: IJob = JobsService.job;

  constructor(private navControl: NavController,
              public router: Router) {

    this.job = JSON.parse(localStorage.getItem('job_details'));

    console.log(this.job);
   }

  ngOnInit() {
  }

}
