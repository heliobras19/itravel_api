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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->string('partida');
            $table->string('destino');
            $table->string('data_ida');
            $table->string('data_regresso');
            $table->integer('num_passageiros');
            $table->string('nome_responsavel');
            $table->string('contato_responsavel');
            $table->boolean('paga')->default(false);
            $table->json('amadeus_data');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
