import { Inject, Injectable, InjectionToken, Optional } from '@angular/core';
import { HttpClient, HttpHeaders, HttpErrorResponse } from '@angular/common/http';
import { Observable } from 'rxjs';
import { map } from 'rxjs';

export const API_BASE_MAIN_URL = new InjectionToken<string>('API_BASE_MAIN_URL');

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  private http: HttpClient;
  private baseUrl: string;
  protected jsonParseReviver: ((key: string, value: any) => any) | undefined = undefined;

  constructor(@Inject(HttpClient) http: HttpClient, @Optional() @Inject(API_BASE_MAIN_URL) baseUrl?: string) {
    this.http = http;
    this.baseUrl = baseUrl ? baseUrl : "";
   }

   register(data: any): Observable<any> {

    const headers = new HttpHeaders({
      'Content-Type': 'application/json'
    });

    const json = JSON.stringify(data);
     return this.http.post(`${this.baseUrl}register`, json, {headers: headers});
   }

}
