import { Inject, Injectable, InjectionToken, Optional } from '@angular/core';
import { HttpClient, HttpHeaders, HttpErrorResponse } from '@angular/common/http';
import { Observable } from 'rxjs';
import { environment } from 'src/environments/environment';
import { CoreEnvironment } from '@angular/compiler/src/compiler_facade_interface';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  private http: HttpClient;
  private baseUrl: string;


  constructor(private httpClient: HttpClient) {
    this.http = httpClient;
    this.baseUrl = environment.baseUrl
   }

   register(data: any): Observable<any> {
    const headers = new HttpHeaders({
      'Content-Type': 'application/json'
    });

    const json = JSON.stringify(data);
     return this.http.post(`${this.baseUrl}/register`, json, {headers: headers});
   }



   login(data: any): Observable<any> {
    const headers = new HttpHeaders({
      'Content-Type': 'application/json'
    });

    const json = JSON.stringify(data);
     return this.http.post(`${this.baseUrl}/login`, json, {headers: headers});
   }
}
