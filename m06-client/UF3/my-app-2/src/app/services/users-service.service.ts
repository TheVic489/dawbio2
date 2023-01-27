import { Injectable } from '@angular/core';
import { User } from '../model/User';
import { CookieService } from 'ngx-cookie-service';

@Injectable({
  providedIn: 'root',
})
export class UsersServiceService {
  constructor(private cookieService: CookieService) {}
  myUsersArray: User[] = [];
  // Métodos que generen/devuelvan datos
  getUsers(){
    let auxiliar: User[] = [new User('user01', 'pass01', 'comprador', 'pepito@mail.cat',    'Soltero/a',    'Hombre', 'Musica', 'True'),
                            new User('user02', 'pass01', 'comprador', 'alejandra@mail.cat', 'Divorciat/da', 'Mujer',  'Accesoris', 'True'),
                            new User('user03', 'pass01', 'comprador', 'maria@mail.cat',     'Casat/da',     'Hombre', '', 'True'),
                            ];

    for (let i: number = 0; i < 20; i++) {
      let j = Math.floor(Math.random() * 3);

      this.myUsersArray.push(auxiliar[j]);
    }
  }
  // Validate and return role of user
  validateUser(usern: any, pass: any): string {
    let role = '';
    this.myUsersArray.forEach(user => {
      if (user.username === usern && user.password === pass) {
        role = user.role

        this.cookieService.set('username', user.username);
        this.cookieService.set('role', user.role);

      } 
    });
    return role
  }

  registerUser(user2reg: User): any {
    this.myUsersArray.push(user2reg);
  }
}
