<?php
declare(strict_types=1);

namespace Tests\domain\repositories;

use App\Models\ChamadosModel;
use App\Models\ClienteModel;
use App\Repositories\ChamadosRepositorio;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChamadosRepositoryTest extends TestCase
{
    protected $repositorio;

    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        $this->repositorio = new ChamadosRepositorio();
    }

    public function test_create_novo_chamado()
    {
        ClienteModel::factory()->create();
        $dados = ChamadosModel::factory()->make();

        $input = $dados->toArray();

        $resultado = $this->repositorio->save($input);

        $this->assertInstanceOf(ChamadosModel::class, $resultado);
        $this->assertDatabaseCount('chamados', 1);
        $this->assertEquals($dados->cham_titulo, $resultado->cham_titulo);
        $this->assertEquals($dados->cham_texto, $resultado->cham_texto);
        $this->assertEquals($dados->cham_criado_em, $resultado->cham_criado_em);
        $this->assertEquals($dados->cham_canal_criado, $resultado->cham_canal_criado);
        $this->assertEquals($dados->cliente_id, $resultado->cliente_id);
    }

    public function test_find_um_chamado()
    {
        ClienteModel::factory()->create();
        ChamadosModel::factory()->create();
        $id = ChamadosModel::all()->random()->cham_id;

        $resultado = $this->repositorio->find($id);

        $this->assertInstanceOf(ChamadosModel::class, $resultado);
        $this->assertEquals($id, $resultado->cham_id);
    }

    public function test_find_um_chamado_throw_not_found_exception()
    {
        $id = 1;

        $this->expectException(ModelNotFoundException::class);

        $this->repositorio->find($id);
    }

    public function test_get_chamados_by_cliente()
    {
        ClienteModel::factory()->create();
        ChamadosModel::factory()->count(3)->create();

        $resultado = $this->repositorio->getWhere(['cliente_id' => 1]);

        $this->assertInstanceOf(Collection::class, $resultado);
        $this->assertCount(3, $resultado);
    }

    public function test_get_chamados_by_canal()
    {
        ClienteModel::factory()->create();
        $dados = ChamadosModel::factory()->count(3)->create();

        $resultado = $this->repositorio->getWhere(['cham_canal_criado' => $dados[0]->cham_canal_criado]);

        $this->assertInstanceOf(Collection::class, $resultado);
        $this->assertCount(1, $resultado);
    }
}
