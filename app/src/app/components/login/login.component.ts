import { Component, OnInit } from '@angular/core';
import {  Validators } from '@angular/forms';
import { AuthService } from 'src/app/shared/services/auth.service';
import { FormBuilder } from '@angular/forms';
import { Router } from '@angular/router';
import { TokenStorageService } from 'src/app/shared/services/token.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  loginForm;
  isLoggedIn = false;
  isLoginFailed = false;
  errorMessage = '';
  roles: string[] = [];

  constructor(private authService: AuthService, private formBuilder: FormBuilder, private router: Router, private tokenStorage: TokenStorageService) {
    this.loginForm = this.formBuilder.group({
      email: [new String, Validators.email],
      password: new String,
    })
  }

  ngOnInit(): void {
    if (this.tokenStorage.getToken()) {
      this.isLoggedIn = true;
      this.roles = this.tokenStorage.getUser().roles;
    }
  }

  login(): void {
    this.authService.login(this.loginForm.value)
      .subscribe({
        next: (data) => {
          this.tokenStorage.saveToken(data.token);
          this.tokenStorage.saveUser(data.user);
          this.isLoginFailed = false;
          this.isLoggedIn = true;
          this.roles = this.tokenStorage.getUser().roles;
          this.reloadPage();
        },
        error: (error) => console.error(error),
        complete: () => this.router.navigate(['/'])
      })
  }
  reloadPage(): void {
    window.location.reload();
  }
}

