import { Component, OnInit } from '@angular/core';
import { UsersServiceService } from 'src/app/services/users-service.service';
import { CookieService } from 'ngx-cookie-service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-esdeveniments',
  templateUrl: './esdeveniments.component.html',
  styleUrls: ['./esdeveniments.component.css'],
})
export class EsdevenimentsComponent implements OnInit {
  constructor(
    private serviceUser: UsersServiceService,
    private cookieService: CookieService,
    private router: Router
  ) {}
  isLogged!: boolean;

  ngOnInit() {
    this.handleSesison();

    //this.serviceUser.getUsers();
  }

  handleSesison(){
    /// HANDLE SESSION ///
    // Reload page to show logout button
    if (sessionStorage.getItem('reloaded') === null) {
      sessionStorage.setItem('reloaded', 'true');
      window.location.reload();
    }
    // If it's not logged, redirect to login
    this.isLogged = this.serviceUser.checkCookieSession();

    if (!this.isLogged) { 
      this.router.navigate(['/login']);
    }
    /////////////////////////////////////////////7
  }
}
