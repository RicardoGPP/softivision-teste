import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { HttpModule } from '@angular/http'
import { RouterModule } from '@angular/router'
import { FormsModule } from '@angular/forms'
import { BrowserAnimationsModule } from '@angular/platform-browser/animations'
import { ROTAS } from './util/routes.util'
import { AppComponent } from './app.component';
import { FuncionarioCargoItemComponent } from './component/funcionario-cargo-item/funcionario-cargo-item.component';
import { FuncionarioCargoListaComponent } from './component/funcionario-cargo-lista/funcionario-cargo-lista.component';
import { FuncionarioCargoCadastroComponent } from './component/funcionario-cargo-cadastro/funcionario-cargo-cadastro.component';


@NgModule({
  declarations: [
    AppComponent,
    FuncionarioCargoItemComponent,
    FuncionarioCargoListaComponent,
    FuncionarioCargoCadastroComponent
  ],
  imports: [
    BrowserModule,
    HttpModule,
    RouterModule.forRoot(ROTAS),
    FormsModule,
    BrowserAnimationsModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
