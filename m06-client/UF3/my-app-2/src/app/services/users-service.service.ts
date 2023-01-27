import { Injectable } from '@angular/core';
import { User } from '../model/User';

@Injectable({
  providedIn: 'root',
})
export class UsersServiceService {
  constructor() {}

  myUsersArray: object[] = []

  // Métodos que generen/devuelvan datos
  getUsers(): object[]|void {
    let users:    string[] = [];
    let user:     User     = new User('pepitogrillo', 'pass01' , 'comprador' , 'pepito@mail.cat', 'Soltero/a', 'Hombre', '', 'True');
    let auxiliar: string[] = ['manzanas', 'fresas', 'sandias', 'peras'];

    for (let i: number = 0; i < 100; i++) {
      let j = Math.floor(Math.random() * 2);

      users.push(auxiliar[j]);
    }

 //  return users;
  }
  // VAlidate and return role of user
  validateUser(username: string, password: string): string {
    
    let role = '';

    return  role
  }

  registerUser(user2reg: object): any {
    this.myUsersArray.push(user2reg);
  }
}
