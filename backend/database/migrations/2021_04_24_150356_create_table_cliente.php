<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCliente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente', function (Blueprint $table) {
            $table->id('clie_id');
            $table->string('clie_nome_completo', 255);
            $table->string('clie_cpf', 255);
            $table->string('clie_email', 255);
            $table->date('clie_data_nascimento');
            $table->string('clie_celular', 255);
            $table->string('clie_cep', 9);
            $table->string('clie_endereco', 255);
            $table->string('clie_complemento', 255);
            $table->string('clie_bairro', 255);
            $table->string('clie_municipio', 255);
            $table->string('clie_estado', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cliente');
    }
}
