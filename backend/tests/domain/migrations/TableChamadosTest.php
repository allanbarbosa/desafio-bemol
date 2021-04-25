<?php
declare(strict_types=1);

namespace Tests\domain\migrations;

use App\Models\ChamadosModel;
use App\Models\ClienteModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class TableChamadosTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        $this->cliente = ClienteModel::factory()->create();
        $this->chamados = ChamadosModel::factory()->create();
    }

    public function test_table_chamados_exists()
    {
        $this->assertTrue(Schema::hasTable('chamados'));
    }

    public function test_table_chamados_has_columns()
    {
        $this->assertTrue(Schema::hasColumn('chamados', 'cham_id'));
        $this->assertTrue(Schema::hasColumn('chamados', 'cliente_id'));
        $this->assertTrue(Schema::hasColumn('chamados', 'cham_titulo'));
        $this->assertTrue(Schema::hasColumn('chamados', 'cham_texto'));
        $this->assertTrue(Schema::hasColumn('chamados', 'cham_criado_em'));
        $this->assertTrue(Schema::hasColumn('chamados', 'cham_canal_criado'));
        $this->assertTrue(Schema::hasColumn('chamados', 'cham_canal_encerramento'));
        $this->assertTrue(Schema::hasColumn('chamados', 'cham_encerrado_em'));
    }

    public function test_o_chamado_tem_um_cliente()
    {
        $this->assertInstanceOf(ClienteModel::class, $this->chamados->cliente);

        $this->assertEquals(1, $this->chamados->cliente->count());
    }
}
