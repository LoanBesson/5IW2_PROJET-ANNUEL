import { Component, OnInit } from '@angular/core';
import { NgForm, Validators } from '@angular/forms';
import { AuthService } from 'src/app/shared/services/auth.service';
import { FormBuilder } from '@angular/forms';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  loginForm;

  constructor(private authService: AuthService, private formBuilder: FormBuilder) {
    this.loginForm = this.formBuilder.group({
      email: [new String, Validators.email],
      password: new String,
    })
  }


  ngOnInit(): void {
  }

  login(): void {
    this.authService.login(this.loginForm.value)
      .subscribe({
        next: (v) => console.log(v.token),
        error: (e) => console.error(e),
        complete: () => console.info('complete')
      })
  }




}

