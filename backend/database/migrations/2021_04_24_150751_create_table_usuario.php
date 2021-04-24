<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->id('usua_id');
            $table->string('usua_login', 255);
            $table->string('usua_password', 255);
            $table->dateTime('usua_renew_password')->default(now()->addMonths(3));
            $table->boolean('usua_first_access')->default(true);
            $table->dateTime('usua_email_verified_at')->nullable();
            $table->unsignedBigInteger('cliente_id');
            $table->timestamps();

            $table->index('cliente_id', 'usuario_cliented_id_idx');

            $table->foreign('cliente_id', 'fk_usuario_cliente_id')->references('clie_id')->on('cliente');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario');
    }
}
