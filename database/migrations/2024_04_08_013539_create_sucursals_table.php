<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sucursales', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('direccion');
            $table->string('telefono')-> nullable();
            $table->string('email') -> nullable();
            $table->string('estado');
            $table->string('responsable');
            $table->unsignedBigInteger('empresa_id');
            //Relaciones
            $table->foreign('empresa_id')->references('id')->on('empresas');
            //Opciones de borrado
            $table->softDeletes();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sucursals');
    }
};
