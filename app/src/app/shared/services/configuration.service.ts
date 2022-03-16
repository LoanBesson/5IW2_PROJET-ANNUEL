import { Injectable, InjectionToken } from "@angular/core";
export const API_BASE_URL = new InjectionToken<string>('API_BASE_URL')

export function configServiceFactory(configurationService: ConfigurationService, file: string, property: string) {
  return configurationService.load(file);
}

@Injectable()
export class ConfigurationService {
  constructor() {

  }

  load(filepath: any) {
    const json = this.getConfigFile(filepath, "application/json");
    return json
  }

  public getConfigFile(filepath: any, mimeType: string) {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", filepath, false)
    if (mimeType != null) {
      if (xhr.overrideMimeType) {
        xhr.overrideMimeType(mimeType)
      }
    }
    xhr.send();
    if (xhr.status === 200) {
      console.log(xhr);
      
      return xhr.responseText
    } else {
      return null
    }
  }
}