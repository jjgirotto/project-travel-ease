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
        Schema::create('passagems', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('checkin');
            $table->date('checkout');
            $table->string('aeroOrigem', 100);
            $table->string('aeroDestino', 100);
            $table->unsignedBigInteger('viagem_id');
            $table->foreign('viagem_id')->references('id')->on('viagems')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passagems');
    }
};
