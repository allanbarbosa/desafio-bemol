import { ViaCepService } from './../../services/viacep.service';
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
    private formBuilder: FormBuilder,
    private viaCepService: ViaCepService
  ) { }

  ngOnInit(): void {
    this.inicializarFormulario();
  }

  onSubmit(): void {
    console.log("entrou");
  }

  searchCep(): void {
    const cep = this.formulario.value.cep.replace('-', '');
    this.formulario.controls.endereco.setValue('Buscando endereço...');
    this.viaCepService.get(cep).subscribe(
      (viacep) => {
        this.formulario.controls.endereco.setValue(viacep.logradouro);
        this.formulario.controls.complemento.setValue(viacep.complemento);
        this.formulario.controls.cidade.setValue(viacep.localidade);
        this.formulario.controls.estado.setValue(viacep.uf);
      },
      (e) => {
        console.log(e);
      }
    );
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
