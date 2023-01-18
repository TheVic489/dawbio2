import { Component, OnInit } from '@angular/core';
import { ServicioFrutasService } from 'src/app/services/servicio-frutas.service';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { User } from 'src/app/model/User';

@Component({
  selector: 'app-compo1',
  templateUrl: './compo1.component.html',
  styleUrls: ['./compo1.component.css'],
})
export class Compo1Component {
  registerUserData!: User;

  estado = ['Casat/da', 'Solter/a', 'Divorciat/da'];
  informacio = ['Música', 'Accesoris', 'Roba'];

  myForm = new FormGroup({

    username: new FormControl('', [
      Validators.required,
      Validators.minLength(6),
      Validators.pattern('^[A-Za-zñÑáéíóúÁÉÍÓÚ ]+$'),
    ]),
    
    correo: new FormControl('', [
      Validators.required,
      // Validators.email
      Validators.pattern(
        "^[a-z0-9!#$%&'+/=?^_`{|}~-]+(?:.[a-z0-9!#$%&'+/=?^_`{|}~-]+)@(?:[a-z0-9](?:[a-z0-9-][a-z0-9])?.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$"
      ),
    ]),
    
    edad: new FormControl('', [
      Validators.required,
      //se puede poner un validator con pattern
    ]),
    
    password: new FormControl('', [
      Validators.required,
      Validators.minLength(8),
    ]),
    
    sexe:            new FormControl('', [Validators.required]),
    checkcondicions: new FormControl('', [Validators.required]),
    estat:           new FormControl('', [Validators.required]),
    info:            new FormControl('', [Validators.required]),
  });
  submit() {
    //solo si clicas
    this.registerUserData = new User(
      this.myForm.value.username,
      this.myForm.value.password,
      'registered',
      this.myForm.value.correo,
      this.myForm.value.estat,
      this.myForm.value.sexe,
      this.myForm.value.info,
      this.myForm.value.checkcondicions
    );
  }
}
