<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('data_bukus', function (Blueprint $table) {
            // Hapus foreign key dulu
            $table->dropForeign(['kategori_id']);
            // Baru hapus kolom
            $table->dropColumn('kategori_id');
        });
    }

    public function down(): void
    {
        Schema::table('data_bukus', function (Blueprint $table) {
            $table->foreignId('kategori_id')->constrained('data_kategoris')->onDelete('cascade');
        });
    }
};
