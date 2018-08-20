import { Injectable } from '@angular/core'
import { Http, URLSearchParams } from '@angular/http'
import { Observable } from 'rxjs'
import { map } from 'rxjs/operators'
import { Resposta } from '../model/resposta.model'
import { FuncionarioCargo } from '../model/funcionario-cargo.model'
import { API } from '../util/rest.util'

@Injectable()
export class FuncionarioCargoService {
  public constructor(private _http: Http) {}

  public obterRegistro(codigo: number): Observable<Resposta<FuncionarioCargo>> {
    return this._http.get(`${API}/funcionario-cargo/buscar/${codigo}`).pipe(map(response => response.json()))
  }

  public obterLista(): Observable<Resposta<FuncionarioCargo[]>> {
    return this._http.get(`${API}/funcionario-cargo/listar`).pipe(map(response => response.json()))
  }

  public incluir(funcionarioCargo: FuncionarioCargo): Observable<Resposta<FuncionarioCargo>> {
    return this._http.post(`${API}/funcionario-cargo/incluir`, this.httpIncluir(funcionarioCargo)).pipe(map(response => response.json()))
  }

  public excluir(codigo: number): Observable<Resposta<FuncionarioCargo>> {
    return this._http.get(`${API}/funcionario-cargo/excluir/${codigo}`).pipe(map(response => response.json()))
  }

  public editar(funcionarioCargo: FuncionarioCargo): Observable<Resposta<FuncionarioCargo>> {
    return this._http.post(`${API}/funcionario-cargo/editar`, this.httpEditar(funcionarioCargo)).pipe(map(response => response.json()))
  }

  private httpIncluir(funcionarioCargo: FuncionarioCargo): URLSearchParams {
    let corpo = new URLSearchParams()
    corpo.append('cargo', funcionarioCargo.cargo.codigo.toString())
    corpo.append('empresa', funcionarioCargo.empresa.codigo.toString())
    corpo.append('data_inicio', funcionarioCargo.dataInicio)
    corpo.append('data_fim', funcionarioCargo.dataFim)
    corpo.append('descricao', funcionarioCargo.descricao)
    return corpo
  }

  private httpEditar(funcionarioCargo: FuncionarioCargo): URLSearchParams {
    let corpo = this.httpIncluir(funcionarioCargo)
    corpo.append('codigo', funcionarioCargo.codigo.toString())
    return corpo
  }
}