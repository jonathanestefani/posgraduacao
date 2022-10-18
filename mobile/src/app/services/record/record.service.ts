import { Injectable } from '@angular/core';
import { ApiService } from '../api.service';

@Injectable({
  providedIn: 'root'
})
export class RecordService {

  resource = 'record';

  types = [
    { id: 1, name: "Administrador" },
    { id: 2, name: "Usuário" },
    { id: 3, name: "Empresa" },
  ];

  constructor(private http: ApiService) { }

  public record(params: {}) {
    if (params['id']) {
      return this.http.put(this.resource + '/' + params['id'], params);
    } else {
      return this.http.post(this.resource, params);
    }
  }

  public getTypes() {
    return this.types;
  }
}
