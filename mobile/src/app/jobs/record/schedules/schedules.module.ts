import { CUSTOM_ELEMENTS_SCHEMA, NgModule, NO_ERRORS_SCHEMA } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { SchedulesPageRoutingModule } from './schedules-routing.module';
import { DaysOfWeekComponent } from './component/days-of-week/days-of-week.component';
import { SchedulesPage } from './schedules.page';
import { HoursOfTheWeekComponent } from './component/hours-of-the-week/hours-of-the-week.component';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    SchedulesPageRoutingModule
  ],
  declarations: [SchedulesPage, DaysOfWeekComponent, HoursOfTheWeekComponent],
})
export class SchedulesPageModule {}
