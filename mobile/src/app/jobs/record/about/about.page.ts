import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { NavController } from '@ionic/angular';

@Component({
  selector: 'app-about',
  templateUrl: './about.page.html',
  styleUrls: ['./about.page.scss'],
})
export class AboutPage implements OnInit {

  form = {
    id: 0,
    name: ''
  };

  constructor(private navControl: NavController,
              public router: Router) {}

  ngOnInit() {
  }

}
