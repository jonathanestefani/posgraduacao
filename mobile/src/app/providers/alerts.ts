import { Injectable } from '@angular/core';
import {
  ToastController,
  LoadingController,
  AlertController,
} from '@ionic/angular';

export enum ETypeAlertToast {
  danger = 'danger',
  success = 'success',
};

export enum ETypeAlert {
  confirm = 'confirm',
  ok = 'ok',
};

@Injectable()
export class Alerts {
  private load = null;
  private msg = '';

  constructor(
    private toast: ToastController,
    private loadCtrl: LoadingController,
    private alertCtrl: AlertController
  ) {}

  async alertToast(msg: string, etype: ETypeAlertToast = ETypeAlertToast.success, time: number = 2000) {
    let msgColor = 'success';

    if (etype === ETypeAlertToast.danger) {
      time = 5000;
      msgColor = 'danger';
    }

    (await this.toast.create({
        duration: time,
        position: 'bottom',
        message: msg,
        color: msgColor,
        buttons: [
          { text: 'Ok' }
        ]
      })
    ).present();
  }

  async loading(vmsg: string = 'Aguarde...') {
    console.log(this.load);

    if (this.load !== null) {
      await this.load.dismiss();
      this.load = null;
    } else {
      this.load = await this.loadCtrl.create({
        message: vmsg,
      });
      await this.load.present();
    }
  }

  alert(title: string = 'Confirmação', message: string = '', type: ETypeAlert) {
    return new Promise(async (resolve, reject) => {
      let buttonsOptions = [];

      if (type === ETypeAlert.confirm) {
        buttonsOptions = [
          {
            text: 'Não',
            handler: () => {
              reject(true);
            },
          },
          {
            text: 'Sim',
            handler: () => {
              resolve(true);
            },
          },
        ];
      } else {
        buttonsOptions = [
          {
            text: 'OK',
            handler: () => {
              reject(true);
            }
          }
        ];
      }

      (await this.alertCtrl.create({
          header: title,
          subHeader: message,
          buttons: buttonsOptions,
        })
      ).present();
    });
  }

}
