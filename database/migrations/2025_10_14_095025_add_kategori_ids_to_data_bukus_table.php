<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('data_bukus', function (Blueprint $table) {
            $table->string('kategori_ids')->nullable()->after('bahasa');
        });
    }

    public function down(): void
    {
        Schema::table('data_bukus', function (Blueprint $table) {
            $table->dropColumn('kategori_ids');
        });
    }
};
