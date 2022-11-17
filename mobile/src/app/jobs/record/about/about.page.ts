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
    name: '',
    status: 1,
    // eslint-disable-next-line @typescript-eslint/naming-convention
    job_info: [],
  };

  // eslint-disable-next-line @typescript-eslint/naming-convention
  job_info = [
    { name: 'Descrição', text: '', value: '' },
    { name: 'Valor', text: '', value: '' },
  ];

  constructor(private navControl: NavController, public router: Router) {}

  ngOnInit() {}
}
