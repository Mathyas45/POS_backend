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
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('tipo_comprobante');
            $table->string('serie');
            $table->string('correlativo');
            $table->decimal('subtotal', 8, 2);
            $table->decimal('total', 8, 2);
            $table->string('forma_pago');
            $table->string('estado');
            $table->unsignedBigInteger('proveedor_id');
            $table->unsignedBigInteger('moneda_id');
            $table->unsignedBigInteger('sucursal_id');


            //Llaves foraneas
            $table->foreign('proveedor_id')->references('id')->on('proveedores');
            $table->foreign('moneda_id')->references('id')->on('monedas');
            $table->foreign('sucursal_id')->references('id')->on('sucursales');




            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
