<?php
declare(strict_types=1);

namespace Tests\domain\services;

use App\Models\ChamadosModel;
use App\Repositories\ChamadosRepositorio;
use App\Services\ChamadosServico;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\WithFaker;
use Prophecy\PhpUnit\ProphecyTrait;
use Tests\TestCase;

class ChamadosServiceTest extends TestCase
{
    use ProphecyTrait, WithFaker;

    protected $repositorio;
    protected $servico;

    public function setUp(): void
    {
        parent::setUp();

        $this->faker = $this->faker('pt_BR');
        $this->repositorio = $this->prophesize(ChamadosRepositorio::class);
        $this->servico = new ChamadosServico($this->repositorio->reveal());
    }

    public function test_create_a_chamado()
    {
        $input = $this->factoryData();
        $repositoryData = $this->repositoryFactory($input);

        $chamado = new ChamadosModel($repositoryData);
        $chamado->cham_id = 1;

        $this->repositorio->save($repositoryData)->willReturn($chamado)->shouldBeCalled();

        $input['id'] = $chamado->cham_id;
        $resposta = $this->servico->save($input);

        $this->prophet->checkPredictions();
        $this->assertIsArray($resposta);
        $this->assertEquals($input, $resposta);
    }

    public function test_find_um_chamado()
    {
        $input = $this->factoryData();
        $repositoryData = $this->repositoryFactory($input);
        $chamado = new ChamadosModel($repositoryData);
        $chamado->cham_id = 1;

        $this->repositorio->find($chamado->cham_id)->willReturn($chamado)->shouldBeCalled();

        $resposta = $this->servico->find($chamado->cham_id);
        $input['id'] = $chamado->cham_id;

        $this->prophet->checkPredictions();
        $this->assertIsArray($resposta);
        $this->assertEquals($input, $resposta);
    }

    public function test_find_um_chamado_throw_not_found_exception()
    {
        $id = 1;

        $this->expectException(ModelNotFoundException::class);

        $this->repositorio->find($id)->willThrow(ModelNotFoundException::class)->shouldBeCalled();

        $this->servico->find($id);
    }

    public function test_get_chamados_by_cliente()
    {
        $input = $this->factoryData();
        $repositoryData = $this->repositoryFactory($input);
        $chamado = new ChamadosModel($repositoryData);
        $chamado->cham_id = 1;
        $collection = new Collection();
        $collection->add($chamado);
        $collection->add($chamado);
        $collection->add($chamado);

        $this->repositorio->getWhere(['cliente_id' => 1])->willReturn($collection)->shouldBeCalled();

        $resultado = $this->servico->get(['clienteId' => 1]);

        $this->assertIsArray($resultado);
        $this->assertCount(3, $resultado);
    }

    protected function repositoryFactory(array $input): array
    {
        return [
            'cham_titulo' => $input['titulo'],
            'cham_texto' => $input['texto'],
            'cham_criado_em' => implode('-', array_reverse(explode('/', $input['criadoEm']))),
            'cham_canal_criado' => $input['canalCriado'],
            'cliente_id' => $input['clienteId']
        ];
    }

    protected function factoryData()
    {
        return [
            'titulo' => $this->faker->title(),
            'texto' => $this->faker->text(),
            'criadoEm' => $this->faker->date('d/m/Y'),
            'canalCriado' => $this->faker->slug(),
            'clienteId' => 1
        ];
    }
}
