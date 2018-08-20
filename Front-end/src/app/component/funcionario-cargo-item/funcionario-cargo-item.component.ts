import { Component, OnInit, Input, Output, EventEmitter } from '@angular/core';
import { FuncionarioCargo } from '../../model/funcionario-cargo.model'

@Component({
  selector: 'sv-funcionario-cargo-item',
  templateUrl: './funcionario-cargo-item.component.html',
  styleUrls: ['./funcionario-cargo-item.component.css']
})
export class FuncionarioCargoItemComponent implements OnInit {
  @Input() public funcionarioCargo: FuncionarioCargo = null
  @Output() public eventoCliqueExcluirPai = new EventEmitter

  public ngOnInit() {}

  public eventoCliqueExcluir(): void {
    this.eventoCliqueExcluirPai.emit()
  }

  public eCargoAtual(): boolean {
    return this.funcionarioCargo.dataFim == null
  }
}
