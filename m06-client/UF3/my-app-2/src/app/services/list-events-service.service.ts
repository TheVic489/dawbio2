import { Injectable } from '@angular/core';
import { Event }  from '../model/Esdeveniments';
// import { UsersServiceService } from 'src/app/services/users-service.service';
// import { CookieService }       from 'ngx-cookie-service';
// import { Router } from '@angular/router';

@Injectable({
  providedIn: 'root'
})
export class ListEventsServiceService {

  constructor(
    // private serviceUser: UsersServiceService,
    // private cookieService: CookieService,
    // private router: Router
  ) { }

  events: Event[] = [];
  eventTypes  = ['Music', 'Sports', 'Theater', 'Comedy', 'Technology', 'Anime'];
  eventPlaces = ['New York', 'London', 'Paris', 'Berlin', 'Tokyo', 'Barcelona', 'Albacete'];
  eventDates  = ['10-12-2023', '03-02-2023', '04-10-2023', '10-12-2023', '01-03-2023'];
  
  getEvents() {
    // Generate 100 events randomly
    for (let i = 0; i < 100; i++) {
      const eventName = `Event ${i + 1}`;
      const eventType = this.eventTypes[Math.floor(Math.random() * this.eventTypes.length)];
      const eventDate = this.eventDates[Math.floor(Math.random() * this.eventDates.length)];
      const eventPlace = this.eventPlaces[Math.floor(Math.random() * this.eventPlaces.length)];
      const eventPrice = (Math.floor(Math.random() * 100) + 1) + '€';
    
      const event = new Event(eventName, eventType, eventDate, eventPlace, eventPrice);
      this.events.push(event);

    }

    console.log(this.events);
    return this.events;
  }  


}
