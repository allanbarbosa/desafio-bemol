<?php
declare(strict_types=1);

namespace Tests\domain\repositories;

use App\Models\ClienteModel;
use App\Models\UsuarioModel;
use App\Repositories\UsuarioRepositorio;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsuarioRepositoryTest extends TestCase
{
    protected $repositorio;

    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        $this->repositorio = new UsuarioRepositorio();
    }

    public function test_create_novo_usuario()
    {
        ClienteModel::factory()->create();
        $dados = UsuarioModel::factory()->make();

        $input = $dados->toArray();

        $resultado = $this->repositorio->save($input);

        $this->assertInstanceOf(UsuarioModel::class, $resultado);
        $this->assertDatabaseCount('usuario', 1);
        $this->assertEquals($dados->usua_login, $resultado->usua_login);
        $this->assertEquals($dados->cliente_id, $resultado->cliente_id);
        $this->assertTrue($resultado->usua_first_access);
        $this->assertNull($resultado->usua_email_verified_at);
    }

    public function test_find_um_usuario()
    {
        ClienteModel::factory()->create();
        UsuarioModel::factory()->create();
        $id = UsuarioModel::all()->random()->usua_id;

        $resultado = $this->repositorio->find($id);

        $this->assertInstanceOf(UsuarioModel::class, $resultado);
        $this->assertEquals($id, $resultado->usua_id);
    }

    public function test_find_um_usuario_throw_model_not_found()
    {
        $id = 1;

        $this->expectException(ModelNotFoundException::class);

        $this->repositorio->find($id);
    }
}
