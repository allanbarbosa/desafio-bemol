<?php
declare(strict_types=1);

namespace Tests\domain\migrations;

use App\Models\ClienteModel;
use App\Models\UsuarioModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class TableUsuarioTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        $this->cliente = ClienteModel::factory()->create();
        $this->usuario = UsuarioModel::factory()->create();
    }

    public function test_table_usuario_exists()
    {
        $this->assertTrue(Schema::hasTable('usuario'));
    }

    public function test_table_usuario_has_columns()
    {
        $this->assertTrue(Schema::hasColumn('usuario', 'usua_id'));
        $this->assertTrue(Schema::hasColumn('usuario', 'usua_login'));
        $this->assertTrue(Schema::hasColumn('usuario', 'usua_password'));
        $this->assertTrue(Schema::hasColumn('usuario', 'usua_renew_password'));
        $this->assertTrue(Schema::hasColumn('usuario', 'usua_first_access'));
        $this->assertTrue(Schema::hasColumn('usuario', 'created_at'));
        $this->assertTrue(Schema::hasColumn('usuario', 'updated_at'));
        $this->assertTrue(Schema::hasColumn('usuario', 'cliente_id'));
        $this->assertTrue(Schema::hasColumn('usuario', 'usua_email_verified_at'));
    }

    public function test_o_usuario_tem_cliente()
    {
        $this->assertInstanceOf(ClienteModel::class, $this->usuario->cliente);

        $this->assertEquals(1, $this->usuario->cliente->count());
    }
}
