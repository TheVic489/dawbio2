import { Component, OnInit }   from '@angular/core';
import { UsersServiceService } from 'src/app/services/users-service.service';
import { ListEventsServiceService } from 'src/app/services/list-events-service.service';
import { CookieService }       from 'ngx-cookie-service';
import { Router } from '@angular/router';
import { Event }  from '../model/Esdeveniments';


@Component({
  selector: 'app-esdeveniments',
  templateUrl: './esdeveniments.component.html',
  styleUrls: ['./esdeveniments.component.css'],
})
export class EsdevenimentsComponent implements OnInit {
  constructor( // --> per injectar, serveis, cookies, router
    private serviceUser: UsersServiceService,
    private cookieService: CookieService,
    private router: Router,
    private listeventService: ListEventsServiceService
  ) {}

  isLogged!: boolean;
  events!: Event[];
  page: number = 1;
  
  ngOnInit() {
    //Execute Handle session
    this.handleSesison();
    this.events = this.listeventService.getEvents()
    //this.serviceUser.getUsers();
  }
  
  deleteRow(element: any): void {
    var row = element.parentNode.parentNode;
    row.parentNode.removeChild(row);
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
