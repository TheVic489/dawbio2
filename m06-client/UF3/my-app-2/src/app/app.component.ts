import { Component, OnInit } from '@angular/core';
import { CookieService } from 'ngx-cookie-service';
import { UsersServiceService } from 'src/app/services/users-service.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit {
  constructor(private serviceUser: UsersServiceService,  private cookieService: CookieService) {}

  isLoged!: boolean 
  title = 'my-app-2';
  
  doLogOut() {
    this.cookieService.deleteAll();
    this.cookieService.delete('role', '/');

    window.location.reload();

  }
  ngOnInit(): void {
    this.isLoged = this.serviceUser.checkCookieSession()
    };
  }