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
        Schema::create('orcamentos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('origem', 100);
            $table->string('destino', 100);
            $table->integer('estadia');
            $table->integer('viajantes');
            $table->boolean('acomodacao')->default(false);
            $table->string('preferencia')->nullable();
            $table->integer('qtdeMilhas')->nullable();
            $table->decimal('valorMilhas', 10,2)->nullable();
            $table->decimal('valorTotal', 10,2)->nullable();
            $table->boolean('escolhido')->default(false)->nullable();
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orcamentos');
    }
};
