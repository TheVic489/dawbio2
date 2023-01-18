import { TestBed } from '@angular/core/testing';

import { ServicioFrutasService } from './servicio-frutas.service';

describe('ServicioFrutasService', () => {
  let service: ServicioFrutasService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(ServicioFrutasService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
