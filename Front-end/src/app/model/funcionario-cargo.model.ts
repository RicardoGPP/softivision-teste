import { Entidade } from './entidade.model'
import { Cargo } from './cargo.model'
import { Empresa } from './empresa.model'

export class FuncionarioCargo extends Entidade {
  public cargo: Cargo = new Cargo()
  public empresa: Empresa = new Empresa()
  public dataInicio: string = null
  public dataFim: string = null
  public descricao: string = null

  public constructor() {
    super()
  }
}
