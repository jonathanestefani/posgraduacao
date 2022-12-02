import { Injectable } from '@angular/core';
import { ApiService } from '../api.service';

@Injectable({
  providedIn: 'root',
})
export class RecordService {
  static types = [
    { id: 1, name: 'Administrador', hide: true },
    { id: 2, name: 'Usuário', hide: false },
    { id: 3, name: 'Empresa', hide: false },
  ];

  resource = 'record';

  constructor(private http: ApiService) {}

  public record(params: any = {}) {
    if (params.id) {
      return this.http.put(this.resource + '/' + params.id, params);
    } else {
      return this.http.post(this.resource, params);
    }
  }
}
