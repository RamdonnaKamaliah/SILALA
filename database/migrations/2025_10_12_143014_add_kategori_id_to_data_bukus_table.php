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
    Schema::table('data_bukus', function (Blueprint $table) {
        $table->unsignedBigInteger('kategori_id')->nullable()->after('id');
        $table->foreign('kategori_id')->references('id')->on('data_kategoris')->onDelete('set null');
        $table->dropColumn('kategori');
    });
}

public function down(): void
{
    Schema::table('data_bukus', function (Blueprint $table) {
        $table->string('kategori')->nullable();
        $table->dropForeign(['kategori_id']);
        $table->dropColumn('kategori_id');
    });
}

};
