import { Component, OnInit } from '@angular/core';
import { count } from 'rxjs';
import { ServicioFrutasService } from 'src/app/services/servicio-frutas.service';

@Component({
  selector: 'app-compo1',
  templateUrl: './compo1.component.html',
  styleUrls: ['./compo1.component.css']
})
export class Compo1Component implements OnInit{

  // Declaracion de propiedades de la classe 
  misFrutas!: string[];

  // Para llamar a servicios, carga de cookies
  constructor ( private servicioFrutas: ServicioFrutasService) {

  }
  count(){
    count()
  }
  // Inicializacion de variables 
  ngOnInit(): void {
    this.misFrutas = this.servicioFrutas.getFrutas()

  }
}
