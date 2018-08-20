import { Http } from '@angular/http'
import { Injectable } from '@angular/core'
import { Observable } from 'rxJs'
import { map } from 'rxJs/operators'
import { API } from '../util/rest.util'
import { Resposta } from '../model/resposta.model'
import { Cargo } from '../model/cargo.model'

@Injectable()
export class CargoService {
  public constructor(private _http: Http) {}

  public obterLista(): Observable<Resposta<Cargo[]>> {
    return this._http.get(`${API}/cargo/listar`).pipe(map(response => response.json()))
  }
}
