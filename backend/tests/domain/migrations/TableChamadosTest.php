<?php
declare(strict_types=1);

namespace Tests\domain;

use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class TableChamadosTest extends TestCase
{
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
}
