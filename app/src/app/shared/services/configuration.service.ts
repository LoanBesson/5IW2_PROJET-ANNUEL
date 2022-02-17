import { Injectable } from '@angular/core';
import { environment } from 'src/environments/environment';
import * as deepmerge from 'deepmerge';

@Injectable({
  providedIn: 'root'
})
export class ConfigurationService {

  public settings: AppSettings;

  load(){
    let requests: Promise<AppSettings>[] = [];
    for (let env of environment.appsettings) {
      requests.push(this.getConfigFile(env.url, env.optionnal))      
    }
    return Promise.all(requests).then(settingsList => {
      this.settings = deepmerge.all(settingsList) as AppSettings
    })
  }

  getConfigFile(uri: string, optionnal: boolean): Promise<any>{
    return new Promise((resolve, reject) => {
      const xhr = new XMLHttpRequest();
      xhr.open('GET', 'assets/config.json');

      xhr.addEventListener('readystatechange', () => {
        if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
          this.settings = JSON.parse(xhr.responseText) as AppSettings;          
          resolve(this.settings)          
        } else if (xhr.readyState === XMLHttpRequest.DONE) {
          reject();
        }
      });
      xhr.send(null)
    });
  }
}

export interface AppSettings {
  apiEndpoints: {
    mainApi: string
  }
}

export function appSettingsServiceFactory(appSettingsService: ConfigurationService) {
  console.log(appSettingsService.load());
  return () => appSettingsService.load();
}
