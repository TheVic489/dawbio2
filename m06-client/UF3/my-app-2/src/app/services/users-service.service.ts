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
  // Validate and return role of user
  validateUser(username: string, password: string): string {
    users.forEach(User => {
      
      if (username == dbUsername && password == dbPassword) {

      }

    });
    let role = '';

    return  role
  }
  
  validateUsers(users, userToValidate) {
    for (let i = 0; i < users.length; i++) {
      if (users[i].username === userToValidate.username && users[i].password === userToValidate.password) {
        return true;
      }
    }
    return false;
  }

  registerUser(user2reg: object): any {
    this.myUsersArray.push(user2reg);
  }
}
