import { Component, OnInit } from '@angular/core';
import { UsersService } from 'src/app/shared/services/users.service';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {

  content?: string;
  constructor(private usersService: UsersService) { }
  ngOnInit(): void {
    this.usersService.getUser().subscribe({
      next: (data) => {
        this.content = data
        console.log(this.content);
        
      },
      error: (error) => console.log(error),
      complete: () => console.log('complete')
    })
  }
}