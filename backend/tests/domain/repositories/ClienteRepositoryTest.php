<?php
declare(strict_types=1);

namespace Tests\domain\repositories;

use App\Models\ClienteModel;
use App\Repositories\ClienteRepositorio;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClienteRepositoryTest extends TestCase
{
    protected $repositorio;

    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        $this->repositorio = new ClienteRepositorio();
    }

    public function test_create_novo_cliente()
    {
        $dados = ClienteModel::factory()->make();

        $input = $dados->toArray();

        $resultado = $this->repositorio->save($input);

        $this->assertInstanceOf(ClienteModel::class, $resultado);
        $this->assertDatabaseCount('cliente', 1);
        $this->assertEquals($dados->clie_nome_completo, $resultado->clie_nome_completo);
        $this->assertEquals($dados->clie_cpf, $resultado->clie_cpf);
        $this->assertEquals($dados->clie_email, $resultado->clie_email);
        $this->assertEquals($dados->clie_data_nascimento, $resultado->clie_data_nascimento);
        $this->assertEquals($dados->clie_celular, $resultado->clie_celular);
        $this->assertEquals($dados->clie_cep, $resultado->clie_cep);
        $this->assertEquals($dados->clie_endereco, $resultado->clie_endereco);
        $this->assertEquals($dados->clie_complemento, $resultado->clie_complemento);
        $this->assertEquals($dados->clie_bairro, $resultado->clie_bairro);
        $this->assertEquals($dados->clie_municipio, $resultado->clie_municipio);
        $this->assertEquals($dados->clie_estado, $resultado->clie_estado);
    }

    public function test_find_um_cliente()
    {
        ClienteModel::factory()->create();
        $id = ClienteModel::all()->random()->clie_id;

        $resultado = $this->repositorio->find($id);

        $this->assertInstanceOf(ClienteModel::class, $resultado);
        $this->assertEquals($id, $resultado->clie_id);
    }

    public function test_find_um_cliente_throw_not_found_exception()
    {
        $this->expectException(ModelNotFoundException::class);

        $id = 2;

        $this->repositorio->find($id);
    }

    public function test_update_cliente()
    {
        ClienteModel::factory()->create();
        $cliente = ClienteModel::all()->random();
        $dados = ClienteModel::factory()->make();
        $input = $dados->toArray();

        $resultado = $this->repositorio->update($cliente->clie_id, $input);

        $this->assertInstanceOf(ClienteModel::class, $resultado);
        $this->assertEquals($cliente->clie_id, $resultado->clie_id);
        $this->assertEquals($dados->clie_nome_completo, $resultado->clie_nome_completo);
        $this->assertEquals($dados->clie_cpf, $resultado->clie_cpf);
        $this->assertEquals($dados->clie_email, $resultado->clie_email);
        $this->assertEquals($dados->clie_data_nascimento, $resultado->clie_data_nascimento);
        $this->assertEquals($dados->clie_celular, $resultado->clie_celular);
        $this->assertEquals($dados->clie_cep, $resultado->clie_cep);
        $this->assertEquals($dados->clie_endereco, $resultado->clie_endereco);
        $this->assertEquals($dados->clie_complemento, $resultado->clie_complemento);
        $this->assertEquals($dados->clie_bairro, $resultado->clie_bairro);
        $this->assertEquals($dados->clie_municipio, $resultado->clie_municipio);
        $this->assertEquals($dados->clie_estado, $resultado->clie_estado);
    }

    public function test_update_cliente_throw_not_found_exception()
    {
        $dados = ClienteModel::factory()->make();
        $input = $dados->toArray();

        $this->expectException(ModelNotFoundException::class);

        $this->repositorio->update(1, $input);
    }
}
