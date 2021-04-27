import { HttpClient } from "@angular/common/http";
import { Injectable } from "@angular/core";
import { environment } from "src/environments/environment";

@Injectable({
  providedIn: 'root'
})
export abstract class WebApiService {
  protected url: string;
  protected abstract rotaApiPadrao: string;

  constructor(protected httpCliente: HttpClient) {
    this.url = environment.host;
  }

  protected converterEmParamsUrl(params: any): string {
    const urlParams = [];
    for (const p in params) {
      if (params.hasOwnProperty(p)) {
        urlParams.push(encodeURIComponent(p) + '=' + encodeURIComponent(params[p]));
      }
    }
    return urlParams.join('&');
  }

  protected convertObjToReqParams(obj: any) {
    return Object.keys(obj).map(key => key + '=' + obj[key]).join('&');
  }
}
