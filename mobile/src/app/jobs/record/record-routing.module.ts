import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { RecordPage } from './record.page';

const routes: Routes = [
  {
    path: '',
    component: RecordPage,
    children: [
      {
        path: 'schedules',
        loadChildren: () => import('./schedules/schedules.module').then( m => m.SchedulesPageModule)
      },
      {
        path: 'schedules/:id',
        loadChildren: () => import('./schedules/schedules.module').then( m => m.SchedulesPageModule)
      },
      {
        path: 'about',
        loadChildren: () => import('./about/about.module').then( m => m.AboutPageModule)
      },
      {
        path: 'about/:id',
        pathMatch: 'full',
        loadChildren: () => import('./about/about.module').then( m => m.AboutPageModule)
      },
    ]
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class RecordPageRoutingModule {}
