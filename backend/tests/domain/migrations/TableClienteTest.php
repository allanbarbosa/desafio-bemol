<?php
declare(strict_types=1);

namespace Tests\domain;

use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class DatabaseExistsTests extends TestCase
{
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
}
