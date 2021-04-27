import { Cliente } from './../models/cliente.model';
import { HttpClient } from '@angular/common/http';
import { Injectable } from "@angular/core";
import { WebApiService } from "./core/webapi.service";
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ClienteService extends WebApiService
{
  protected readonly rotaApiPadrao = 'cliente';

  constructor(private httpClient: HttpClient){
    super(httpClient);
  }

  public save(cliente: Cliente): Observable<Cliente> {
    const url = this.url + this.rotaApiPadrao;
    return this.httpClient.post<Cliente>(url, cliente);
  }
}
