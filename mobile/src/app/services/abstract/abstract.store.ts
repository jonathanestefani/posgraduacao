import { Injectable } from '@angular/core';
import { Subject } from 'rxjs';

@Injectable()
export abstract class AbstractStore {
  protected store: any;
  protected update: Subject<any> = new Subject<any>();

  constructor() {
    this.newModel();
  }

  protected refresh(): Subject<any> {
    return this.update;
  }

  protected set(store: any) {
    this.store = store;
    this.update.next(this.store);
  }

  protected get(): any {
    return this.store;
  }

  protected newModel() {
    this.store = null;

    this.update.next(this.store);
  }

}
