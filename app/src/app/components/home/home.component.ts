import { Component, OnInit } from '@angular/core';
import { UsersService } from 'src/app/shared/services/users.service';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {

  constructor(private usersService : UsersService) { }

  ngOnInit(): void {
    this.usersService.getUser().subscribe({
      next: (data) => console.log(data),
      error: (error) => console.error(error),
      complete: () => console.info('complete')
    })
  }

}
