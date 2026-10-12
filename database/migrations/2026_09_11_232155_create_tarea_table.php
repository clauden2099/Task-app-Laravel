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
        Schema::create('tarea', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('detalles')->nullable();
            $table->date('fecha_limite')->nullable();
            $table->datetime('recordatorio')->nullable();
            $table->boolean('destacada')->default(false);
            $table->boolean('completada')->default(false);
            $table->unsignedBigInteger('lista_id');
            $table->foreign('lista_id')->references('id')->on('lista')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tarea', function (Blueprint $table) {
            $table->dropForeign(['lista_id']);
        });
        Schema::dropIfExists('tarea');
    }
};
