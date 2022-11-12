import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { RecordPage } from './record.page';

const routes: Routes = [
  {
    path: '',
    component: RecordPage,
    children: [
      {
        path: 'about',
        loadChildren: () => import('./about/about-routing.module').then( m => m.AboutPageRoutingModule)
      },
      {
        path: 'schedules',
        loadChildren: () => import('./schedules/schedules-routing.module').then( m => m.SchedulesPageRoutingModule)
      }
    ]
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class RecordPageRoutingModule {}
