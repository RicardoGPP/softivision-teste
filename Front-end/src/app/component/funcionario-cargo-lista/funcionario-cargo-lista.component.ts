import { Component, OnInit, Input } from '@angular/core';
import { FuncionarioCargo } from '../../model/funcionario-cargo.model'
import { FuncionarioCargoService } from '../../service/funcionario-cargo.service'

@Component({
  selector: 'sv-funcionario-cargo-lista',
  templateUrl: './funcionario-cargo-lista.component.html',
  styleUrls: ['./funcionario-cargo-lista.component.css'],
  providers: [FuncionarioCargoService]
})
export class FuncionarioCargoListaComponent implements OnInit {
  public funcionarioCargos: FuncionarioCargo[] = []

  public constructor(private _funcionarioCargoService: FuncionarioCargoService) {}

  public ngOnInit() {
    this._funcionarioCargoService.obterLista()
      .subscribe(resposta => this.funcionarioCargos = resposta.retorno)
  }

  public excluir(funcionarioCargo: FuncionarioCargo): void {
    this._funcionarioCargoService.excluir(funcionarioCargo.codigo)
      .subscribe(resposta => (resposta.sucesso)
        ? this.funcionarioCargos = this.funcionarioCargos.filter(fc => fc.codigo != funcionarioCargo.codigo)
        : alert(resposta.mensagem)
      )
  }
}
