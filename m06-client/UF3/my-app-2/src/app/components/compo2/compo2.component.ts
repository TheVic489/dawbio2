import { Component }                          from '@angular/core';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { UsersServiceService }                from 'src/app/services/users-service.service';
import { CookieService } from 'ngx-cookie-service';

@Component({
  selector: 'app-compo2',
  templateUrl: './compo2.component.html',
  styleUrls: ['./compo2.component.css'],
})
export class Compo2Component {
  constructor(private serviceUser: UsersServiceService,  private cookieService: CookieService) {}

  //Init vars
  nombre = '';
  role   = ''
  result = ''

  myForm = new FormGroup({
    username: new FormControl('', [Validators.required]),

    password: new FormControl('', [Validators.required]),
  });

  submit(): void {
    //solo si clicas
    this.serviceUser.getUsers();
    this.serviceUser.validateUser(this.myForm.value.username, this.myForm.value.password)
    // Get cookie 
    this.nombre = this.cookieService.get('nombre');
    this.role   = this.cookieService.get('role');
  }
}
