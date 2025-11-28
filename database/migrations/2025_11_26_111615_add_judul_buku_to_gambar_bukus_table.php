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
    Schema::table('gambar_bukus', function (Blueprint $table) {
        $table->string('judul_buku')->nullable();
    });
}

public function down(): void
{
    Schema::table('gambar_bukus', function (Blueprint $table) {
        $table->dropColumn('judul_buku');
    });
}

};