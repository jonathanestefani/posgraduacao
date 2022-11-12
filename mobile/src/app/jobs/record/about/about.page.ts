import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { NavController } from '@ionic/angular';

@Component({
  selector: 'app-about',
  templateUrl: './about.page.html',
  styleUrls: ['./about.page.scss'],
})
export class AboutPage implements OnInit {

  listJobs: [];
  job = {};

  constructor(private navControl: NavController,
              public router: Router) {

    this.job = JSON.parse(localStorage.getItem('job_details'));

    console.log(this.job);
   }

  ngOnInit() {
  }

}
