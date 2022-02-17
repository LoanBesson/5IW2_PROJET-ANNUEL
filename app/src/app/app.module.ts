import { APP_INITIALIZER, NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { NavbarComponent } from './shared/components/navbar/navbar.component';
import { RegisterComponent } from './components/register/register.component';
import { HttpClientModule } from '@angular/common/http'
import { appSettingsServiceFactory, ConfigurationService } from './shared/services/configuration.service';
import { API_BASE_MAIN_URL } from './shared/services/auth.service'

@NgModule({
  declarations: [
    AppComponent,
    NavbarComponent,
    RegisterComponent
  ],
  imports: [
		BrowserModule.withServerTransition({ appId: 'ng-cli-universal' }),
    AppRoutingModule,
    NgbModule,
    HttpClientModule
  ],
  providers: [{
    provide: APP_INITIALIZER,
    useFactory: appSettingsServiceFactory,
    deps: [ConfigurationService],
    multi: true,
  },
  {
    provide: API_BASE_MAIN_URL, useFactory: (service: ConfigurationService) => "http://localhost/api/", deps: [ConfigurationService]
  },
],
  bootstrap: [AppComponent]
})
export class AppModule { }
