import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root',
})
export class ServicioFrutasService {
  constructor() {}
  
  // Métodos que generen/devuelvan datos
  getFrutas(): string[] {
    let frutas:   string[] = [];
    let auxiliar: string[] = ['manzanas', 'fresas', 'sandias', 'peras'];

    for (let i: number = 0; i < 100; i++) {
      let j = Math.floor(Math.random() * 2);

      frutas.push(auxiliar[j]);
    }

    return frutas;
  }
}
