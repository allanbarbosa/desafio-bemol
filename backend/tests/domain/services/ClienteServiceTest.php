<?php
declare(strict_types=1);

namespace Tests\domain\services;

use App\Models\ClienteModel;
use App\Repositories\ClienteRepositorio;
use App\Services\ClienteServico;
use Faker\Factory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Prophecy\PhpUnit\ProphecyTrait;
use Tests\TestCase;

class ClienteServiceTest extends TestCase
{
    use ProphecyTrait;

    protected $service;
    protected $repository;

    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        $this->repository = $this->prophesize(ClienteRepositorio::class);
        $this->service = new ClienteServico($this->repository->reveal());
    }

    public function test_create_a_cliente()
    {
        $input = $this->factoryData();
        
        $repositoryData = $this->repositoryFactory($input);
        $cliente = ClienteModel::create($repositoryData);
        $this->repository->save($repositoryData)->willReturn($cliente)->shouldBeCalled();

        $resposta = $this->service->save($input);

        $input['id'] = $cliente->clie_id;

        $this->prophet->checkPredictions();
        $this->assertIsArray($resposta);
        $this->assertEquals($input, $resposta);
    }

    public function test_find_a_cliente()
    {
        ClienteModel::factory()->create();
        $cliente = ClienteModel::all()->random();

        $this->repository->find($cliente->clie_id)->willReturn($cliente)->shouldBeCalled();

        $resposta = $this->service->find($cliente->clie_id);
        
        $dados = $cliente->toArray();
        $esperado = $this->factoryData($dados);
        $esperado['id'] = $cliente->clie_id;

        $this->prophet->checkPredictions();
        $this->assertIsArray($resposta);
        $this->assertEquals($esperado, $resposta);
    }

    public function test_find_a_cliente_throw_not_found_exception()
    {
        $id = 1;

        $this->expectException(ModelNotFoundException::class);

        $this->repository->find($id)->willThrow(ModelNotFoundException::class)->shouldBeCalled();

        $this->service->find($id);
    }

    public function test_update_a_cliente()
    {
        $input = $this->factoryData();
        $repositoryData = $this->repositoryFactory($input);
        ClienteModel::factory()->create($repositoryData);
        $cliente = ClienteModel::all()->random();

        $this->repository->update($cliente->clie_id, $repositoryData)->willReturn($cliente)->shouldBeCalled();

        $resposta = $this->service->update($cliente->clie_id, $input);

        $input['id'] = $cliente->clie_id;

        $this->prophet->checkPredictions();
        $this->assertIsArray($resposta);
        $this->assertEquals($input, $resposta);
    }

    public function test_update_a_cliente_throw_not_found_exception()
    {
        $input = $this->factoryData();
        $repositoryData = $this->repositoryFactory($input);
        $id = 1;

        $this->expectException(ModelNotFoundException::class);

        $this->repository->update($id, $repositoryData)->willThrow(ModelNotFoundException::class)->shouldBeCalled();

        $this->service->update($id, $input);
    }

    protected function repositoryFactory($input): array
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
            'clie_municipio' => $input['municipio'],
            'clie_estado' => $input['estado'],
        ];
    }

    protected function factoryData($data = []): array
    {
        $faker = Factory::create('pt_BR');

        return [
            'nomeCompleto' => (!isset($data['clie_nome_completo'])) ? $faker->name() : $data['clie_nome_completo'],
            'cpf' => (!isset($data['clie_cpf'])) ? $faker->cpf(false) : $data['clie_cpf'],
            'email' => (!isset($data['clie_email'])) ? $faker->email() : $data['clie_email'],
            'dataNascimento' => (!isset($data['clie_data_nascimento'])) ? $faker->date('d/m/Y') : date('d/m/Y', strtotime($data['clie_data_nascimento'])),
            'celular' => (!isset($data['clie_celular'])) ? $faker->cellphoneNumber() : $data['clie_celular'],
            'cep' => (!isset($data['clie_cep'])) ? $faker->postcode : $data['clie_cep'],
            'endereco' => (!isset($data['clie_endereco'])) ? $faker->streetAddress : $data['clie_endereco'],
            'complemento' => (!isset($data['clie_complemento'])) ? $faker->secondaryAddress : $data['clie_complemento'],
            'bairro' => (!isset($data['clie_bairro'])) ? $faker->citySuffix : $data['clie_bairro'],
            'municipio' => (!isset($data['clie_municipio'])) ? $faker->city : $data['clie_municipio'],
            'estado' => (!isset($data['clie_estado'])) ? $faker->state : $data['clie_estado'],
        ];
    }
}
