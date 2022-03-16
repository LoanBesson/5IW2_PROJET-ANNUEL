import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class UsersService {
  private http: HttpClient;
  private baseUrl: string;


  constructor(private httpClient: HttpClient) {
    this.http = httpClient;
    this.baseUrl = environment.baseUrl
   }

   getUser(): Observable<any> {
     return this.http.get(`${this.baseUrl}/get-user`);
   }

}
