import { Component, OnInit }   from '@angular/core';
import { UsersServiceService } from 'src/app/services/users-service.service';
import { ListEventsServiceService } from 'src/app/services/list-events-service.service';
import { CookieService }       from 'ngx-cookie-service';
import { Router } from '@angular/router';
import { Event }  from '../model/Esdeveniments';
// Comoponente de los Eventos

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
  
  // Init Variables
  isLogged!: boolean;
  events!:   Event[];
  page:      number = 1;
  myRole!:   string;
  
  ngOnInit() {
    // Execute Handle session
    this.handleSesison();

    // Get events list
    this.events = this.listeventService.getEvents()

    //Get Role
    this.myRole = this.serviceUser.getCookieRole();

  }
  
  deleteRow(element: any): void {
    this.events = this.events.filter(delEvent => delEvent != element)    
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
  }
}
