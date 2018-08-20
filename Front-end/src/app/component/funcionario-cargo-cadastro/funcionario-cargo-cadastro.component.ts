import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router'
import { Cargo } from '../../model/cargo.model'
import { Empresa } from '../../model/empresa.model'
import { FuncionarioCargo } from '../../model/funcionario-cargo.model'
import { CargoService } from '../../service/cargo.service'
import { EmpresaService } from '../../service/empresa.service'
import { FuncionarioCargoService } from '../../service/funcionario-cargo.service'
import { Router } from '@angular/router'

@Component({
  selector: 'sv-funcionario-cargo-cadastro',
  templateUrl: './funcionario-cargo-cadastro.component.html',
  styleUrls: ['./funcionario-cargo-cadastro.component.css'],
  providers: [CargoService, EmpresaService, FuncionarioCargoService]
})
export class FuncionarioCargoCadastroComponent implements OnInit {
  private _adicionando: boolean
  public cargos: Cargo[] = []
  public empresas: Empresa[] = []
  public funcionarioCargo: FuncionarioCargo = new FuncionarioCargo()
  public cargoAtual: boolean = false

  public constructor(private _cargoService: CargoService,
                     private _empresaService: EmpresaService,
                     private _funcionarioCargoService: FuncionarioCargoService,
                     private _activatedRoute: ActivatedRoute,
                     private _router: Router) {
    this._adicionando = this._activatedRoute.routeConfig.path == 'adicionar'
  }

  public ngOnInit() {
    this._cargoService.obterLista().subscribe(resposta => this.cargos = resposta.retorno)
    this._empresaService.obterLista().subscribe(resposta => this.empresas = resposta.retorno)
    if (!this._adicionando) {
      this._funcionarioCargoService.obterRegistro(+this._activatedRoute.snapshot.params['codigo'])
        .subscribe(resposta => {
          this.funcionarioCargo = resposta.retorno
          this.cargoAtual = this.funcionarioCargo.dataFim == null
        })
    }
  }

  public comparar(o1: Cargo | Empresa, o2: Cargo | Empresa): boolean {
    return o1.codigo === o2.codigo;
  }

  public gravar() {
    let funcionarioCargo: FuncionarioCargo = this.funcionarioCargo
    this.funcionarioCargo.dataFim = (this.cargoAtual) ? null : this.funcionarioCargo.dataFim
    let observable = (this._adicionando)
      ? this._funcionarioCargoService.incluir(funcionarioCargo)
      : this._funcionarioCargoService.editar(funcionarioCargo)
    observable.subscribe(resposta => (resposta.sucesso)
      ? this._router.navigate(['/'])
      : alert(resposta.mensagem))
  }
}
