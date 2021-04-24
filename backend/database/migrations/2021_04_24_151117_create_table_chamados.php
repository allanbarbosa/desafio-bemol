<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableChamados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chamados', function (Blueprint $table) {
            $table->id('cham_id');
            $table->unsignedBigInteger('cliente_id');
            $table->string('cham_titulo', 255);
            $table->text('cham_texto');
            $table->dateTime('cham_criado_em');
            $table->string('cham_canal_criado', 255);
            $table->string('cham_canal_encerramento')->nullable();
            $table->dateTime('cham_encerrado_em')->nullable();
            $table->timestamps();

            $table->index('cliente_id', 'chamados_cliente_id_idx');

            $table->foreign('cliente_id', 'fk_chamados_cliente_id')->references('clie_id')->on('cliente');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chamados');
    }
}
