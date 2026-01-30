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
        Schema::table('users', function (Blueprint $blueprint) {
            // role: admin ou user
            $blueprint->string('role')->default('user')->after('password');
        });
    }

    /**
     * Reverte as migrações
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $blueprint) {
            $blueprint->dropColumn('role');
        });
    }
};
