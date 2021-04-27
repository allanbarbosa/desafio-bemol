import { HttpClient } from '@angular/common/http';
import { Injectable } from "@angular/core";
import { Observable } from 'rxjs';
import { ViaCep } from '../models/viacep.model';

@Injectable({
  providedIn: 'root'
})
export class ViaCepService
{
    protected url = 'https://viacep.com.br/ws/';
    protected typeData = 'json';

    constructor(private httpClient: HttpClient){}

    public get(cep: string): Observable<ViaCep> {
      this.url = this.url + cep + '/' + this.typeData;
      return this.httpClient.get<ViaCep>(this.url);
    }
}
