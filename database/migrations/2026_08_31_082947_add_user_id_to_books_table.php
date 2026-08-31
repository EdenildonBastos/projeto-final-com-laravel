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
        Schema::table('books', function (Blueprint $table) {
           // Adiciona a coluna user_id como chave estrangeira para a tabela 'users' existente
          // O nullable() impede erros caso você já tenha livros salvos no banco
        $table->foreignId('user_id')
              ->nullable()
              ->after('id')
              ->constrained('users')
              ->onDelete('cascade'); // Se o usuário for deletado, apaga os livros dele automaticamente
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
           $table->dropForeign(['user_id']);
           $table->dropColumn('user_id');
        });
    }
};
