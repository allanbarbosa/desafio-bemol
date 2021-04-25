<?php
declare(strict_types=1);

namespace Tests\domain\migrations;

use App\Models\ChamadosModel;
use App\Models\ClienteModel;
use App\Models\UsuarioModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class TableClienteTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        $this->cliente = ClienteModel::factory()->create();
        $this->usuario = UsuarioModel::factory()->create();
        $this->chamados = ChamadosModel::factory()->count(3)->create();
    }

    public function test_table_cliente_exists()
    {
        $this->assertTrue(
            Schema::hasTable('cliente')
        );
    }

    public function test_table_cliente_has_columns()
    {
        $this->assertTrue(Schema::hasColumn('cliente', 'clie_id'));
        $this->assertTrue(Schema::hasColumn('cliente', 'clie_nome_completo'));
        $this->assertTrue(Schema::hasColumn('cliente', 'clie_cpf'));
        $this->assertTrue(Schema::hasColumn('cliente', 'clie_email'));
        $this->assertTrue(Schema::hasColumn('cliente', 'clie_data_nascimento'));
        $this->assertTrue(Schema::hasColumn('cliente', 'clie_celular'));
        $this->assertTrue(Schema::hasColumn('cliente', 'clie_cep'));
        $this->assertTrue(Schema::hasColumn('cliente', 'clie_endereco'));
        $this->assertTrue(Schema::hasColumn('cliente', 'clie_complemento'));
        $this->assertTrue(Schema::hasColumn('cliente', 'clie_bairro'));
        $this->assertTrue(Schema::hasColumn('cliente', 'clie_municipio'));
        $this->assertTrue(Schema::hasColumn('cliente', 'clie_estado'));
        $this->assertTrue(Schema::hasColumn('cliente', 'created_at'));
        $this->assertTrue(Schema::hasColumn('cliente', 'updated_at'));
    }

    public function test_a_cliente_tem_usuario()
    {
        $this->assertInstanceOf(UsuarioModel::class, $this->cliente->usuario);

        $this->assertEquals(1, $this->cliente->usuario->count());
    }

    public function test_a_cliente_tem_chamados()
    {
        $this->assertCount(3, $this->cliente->chamado);
    }
}
