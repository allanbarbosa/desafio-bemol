import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';

@Component({
  selector: 'app-registration',
  templateUrl: './registration.component.html',
  styleUrls: ['./registration.component.css']
})
export class RegistrationComponent implements OnInit {

  public formulario!: FormGroup;

  constructor(
    private formBuilder: FormBuilder
  ) { }

  ngOnInit(): void {
    this.inicializarFormulario();
  }

  onSubmit(): void {
    console.log("entrou");
  }

  searchCep(): void {
    console.log(this.formulario.value.cep);
  }

  private inicializarFormulario(): void {
    this.formulario = this.formBuilder.group({
      nomeCompleto: [
        null, Validators.compose([
          Validators.required
        ])
      ],
      cpf: [
        null, Validators.compose([
          Validators.required
        ])
      ],
      email: [
        null, Validators.compose([
          Validators.required
        ])
      ],
      dataNascimento: [
        null, Validators.compose([
          Validators.required
        ])
      ],
      celular: [
        null, Validators.compose([
          Validators.required
        ])
      ],
      endereco: [
        null, Validators.compose([
          Validators.required
        ])
      ],
      complemento: [
        null
      ],
      cidade: [
        null, Validators.compose([
          Validators.required
        ])
      ],
      cep: [
        null, Validators.compose([
          Validators.required
        ])
      ],
      estado: [
        null, Validators.compose([
          Validators.required
        ])
      ]
    });
  }

}
