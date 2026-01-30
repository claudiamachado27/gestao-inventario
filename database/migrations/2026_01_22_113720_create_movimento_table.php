<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Executa as migrações
     */
    public function up(): void
    {
        Schema::create('movimento', function (Blueprint $table) {
            $table->id();
            $table->string('tipo'); // receita ou despesa
            $table->string('descricao');
            $table->decimal('valor', 10, 2);
            $table->date('data');
            $table->foreignId('categoria_id')->constrained('categoria');
            $table->timestamps();
        });
    }

    /**
     * Reverte as migrações
     */
    public function down(): void
    {
        Schema::dropIfExists('movimento');
    }
};
