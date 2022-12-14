import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { DetailsPage } from './details.page';

const routes: Routes = [
  {
    path: '',
    component: DetailsPage,
    children: [
      {
        path: 'schedules',
        loadChildren: () => import('./schedules/schedules.module').then( m => m.SchedulesPageModule)
      },
      {
        path: 'about',
        loadChildren: () => import('./about/about.module').then( m => m.AboutPageModule)
      },
    ]
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class DetailsPageRoutingModule {}
