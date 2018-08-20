import { Http } from '@angular/http'
import { Injectable } from '@angular/core'
import { Observable } from 'rxJs'
import { map } from 'rxJs/operators'
import { API } from '../util/rest.util'
import { Resposta } from '../model/resposta.model'
import { Empresa } from '../model/empresa.model'

@Injectable()
export class EmpresaService {
  public constructor(private _http: Http) {}

  public obterLista(): Observable<Resposta<Empresa[]>> {
    return this._http.get(`${API}/empresa/listar`).pipe(map(response => response.json()))
  }
}
