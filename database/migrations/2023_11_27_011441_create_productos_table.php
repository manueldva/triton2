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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->unsignedBigInteger('iva_id');
            $table->foreign('iva_id')->references('id')->on('ivas');
            $table->string('descripcion', 250);
            $table->decimal('precio', 8, 2);
            $table->decimal('preciocantidad', 8, 2);
            $table->decimal('flete', 8, 2);
            $table->decimal('porcentajeganancia', 8, 2);
            $table->decimal('porcentajefinanciacion', 8, 2);
            $table->decimal('preciofinal', 8, 2);
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
