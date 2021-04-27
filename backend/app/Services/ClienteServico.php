<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\ClienteModel;
use App\Repositories\ClienteRepositorio;

class ClienteServico
{
    protected $repositorio;

    public function __construct(ClienteRepositorio $clienteRepositorio)
    {
        $this->repositorio = $clienteRepositorio;
    }

    public function find(int $id): array
    {
        $cliente = $this->repositorio->find($id);

        return $this->tratarOutput($cliente);
    }

    public function save(array $input): array
    {
        $dados = $this->tratarInput($input);

        $cliente = $this->repositorio->save($dados);
        return $this->tratarOutput($cliente);
    }

    public function update(int $id, array $input): array
    {
        $dados = $this->tratarInput($input);

        $cliente = $this->repositorio->update($id, $dados);
        return $this->tratarOutput($cliente);
    }

    protected function tratarOutput(ClienteModel $clienteModel): array
    {
        return [
            'id' => $clienteModel->clie_id,
            'nomeCompleto' => $clienteModel->clie_nome_completo,
            'cpf' => $clienteModel->clie_cpf,
            'email' => $clienteModel->clie_email,
            'dataNascimento' => date('d/m/Y', strtotime($clienteModel->clie_data_nascimento)),
            'celular' => $clienteModel->clie_celular,
            'cep' => $clienteModel->clie_cep,
            'endereco' => $clienteModel->clie_endereco,
            'complemento' => $clienteModel->clie_complemento,
            'bairro' => $clienteModel->clie_bairro,
            'cidade' => $clienteModel->clie_municipio,
            'estado' => $clienteModel->clie_estado
        ];
    }

    protected function tratarInput(array $input): array
    {
        return [
            'clie_nome_completo' => $input['nomeCompleto'],
            'clie_cpf' => $input['cpf'],
            'clie_email' => $input['email'],
            'clie_data_nascimento' => implode('-', array_reverse(explode('/', $input['dataNascimento']))),
            'clie_celular' => $input['celular'],
            'clie_cep' => $input['cep'],
            'clie_endereco' => $input['endereco'],
            'clie_complemento' => $input['complemento'],
            'clie_bairro' => $input['bairro'],
            'clie_municipio' => $input['cidade'],
            'clie_estado' => $input['estado'],
        ];
    }
}
