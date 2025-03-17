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
        Schema::create('viagems', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->enum('pagamento', ['Débito', 'Pix', 'Crédito']);
            $table->foreign('orcamento_id')->references('id')->on('orcamentos')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('viagems');
    }
};
