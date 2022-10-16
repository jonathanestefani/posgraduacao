import { Component, OnInit } from '@angular/core';
import { NavController } from '@ionic/angular';
import { Alertas } from '../providers/alertas';
import { LoginService } from '../services/login/login.service';

@Component({
  selector: 'app-register',
  templateUrl: './register.page.html',
  styleUrls: ['./register.page.scss'],
})
export class RegisterPage implements OnInit {

  form = {
    email: "jonathan.estefani@gmail.com",
    password: "admin"
  };
  isLoading = false;

  constructor(private navControl: NavController,
    private loginService: LoginService,
    private alertas: Alertas) { }

  ngOnInit() {
  }

  save() {

  }

}
