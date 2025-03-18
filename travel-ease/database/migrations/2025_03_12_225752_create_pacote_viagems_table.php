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
        Schema::create('pacote_viagems', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('passeios');
            $table->text('restaurantes');
            $table->foreign('orcamento_id')->references('id')->on('orcamentos')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacote_viagems');
    }
};
