import { Routes } from '@angular/router'
import { FuncionarioCargoListaComponent } from '../component/funcionario-cargo-lista/funcionario-cargo-lista.component'
import { FuncionarioCargoCadastroComponent } from '../component/funcionario-cargo-cadastro/funcionario-cargo-cadastro.component'

export const ROTAS: Routes = [
  {path: '', component: FuncionarioCargoListaComponent},
  {path: 'adicionar', component: FuncionarioCargoCadastroComponent},
  {path: 'editar/:codigo', component: FuncionarioCargoCadastroComponent},
  {path: '**', component: FuncionarioCargoListaComponent}
]
