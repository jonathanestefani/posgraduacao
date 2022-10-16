import { Injectable } from '@angular/core';
import { ToastController, LoadingController, AlertController } from '@ionic/angular';

@Injectable()
export class Alertas {
  private load = null;

  constructor(private toast: ToastController, private loadCtrl: LoadingController, private alertCtrl: AlertController) {
  }

  async toastShow (vmsg: string, vtipo: string = '', vdurac?:number) {
      let durac = (vdurac !== undefined ? vdurac : 2000);
      let msgColor = "";

      if (vtipo == 'E') {
        durac = 10000;
      }

      if (vtipo === 'E') {
        msgColor = 'danger';
      } else {
        msgColor = 'success';
      }

      const toast = await this.toast.create({
          duration: durac,
          position: 'bottom',
          message: vmsg,
          color: msgColor
        });

      await toast.present();
  }

  async loadShow (vmsg: string = 'Aguarde...') {
    this.load = await this.loadCtrl.create({
        message: vmsg
    });
    await this.load.present();
  }

  async loadStop () {
    await this.load.dismiss();
  }

  async confirma (vtitulo: string = 'Confirmação', vmsg: string = '', vhandle: any = null) {
    const alertCtrl = await this.alertCtrl.create({
      header: vtitulo,
      subHeader: vmsg,
      buttons: [
        {
          text: 'Não',
          role: 'cancel',
          handler: () => {
            vhandle('N');
          }
        },
        {
          text: 'Sim',
          handler: () => {
            vhandle('S');
          }
        }
      ]
    });
    await alertCtrl.present();
  }

  async alerta (vtitulo: string = 'Confirmação', vmsg: string = ''){
    const alertCtrl = await this.alertCtrl.create({
      header: vtitulo,
      subHeader: vmsg,
      buttons: ['OK']
    });

    await alertCtrl.present();
  }
}
