import { ClienteService } from './../../services/cliente.service';
import { ViaCepService } from './../../services/viacep.service';
import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ToastrService } from 'ngx-toastr';
import { Router } from '@angular/router';

@Component({
  selector: 'app-registration',
  templateUrl: './registration.component.html',
  styleUrls: ['./registration.component.css']
})
export class RegistrationComponent implements OnInit {

  public formulario!: FormGroup;

  constructor(
    private formBuilder: FormBuilder,
    private viaCepService: ViaCepService,
    private clienteService: ClienteService,
    private toastrService: ToastrService,
    private router: Router
  ) { }

  ngOnInit(): void {
    this.inicializarFormulario();
  }

  onSubmit(): void {
    const cliente = {
      nomeCompleto: this.formulario.value.nomeCompleto,
      cpf: this.formulario.value.cpf,
      email: this.formulario.value.email,
      dataNascimento: this.formulario.value.dataNascimento,
      celular: this.formulario.value.celular,
      cep: this.formulario.value.cep,
      endereco: this.formulario.value.endereco,
      complemento: this.formulario.value.complemento,
      bairro: this.formulario.value.bairro,
      cidade: this.formulario.value.cidade,
      estado: this.formulario.value.estado
    };

    this.clienteService.save(cliente).subscribe(
      (sucesso) => {
        this.toastrService.success('Registro salvo com sucesso. Em instantes você receberá mais informações.');
        setTimeout(() => {
          this.router.navigate(['/']);
        }, 1000);
      },
      (erro) => {
        this.toastrService.error(erro);
      }
    )
  }

  searchCep(): void {
    const cep = this.formulario.value.cep.replace('-', '');
    this.formulario.controls.endereco.setValue('Buscando endereço...');
    this.viaCepService.get(cep).subscribe(
      (viacep) => {
        this.formulario.controls.endereco.setValue(viacep.logradouro);
        this.formulario.controls.complemento.setValue(viacep.complemento);
        this.formulario.controls.bairro.setValue(viacep.bairro);
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
      bairro: [
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
