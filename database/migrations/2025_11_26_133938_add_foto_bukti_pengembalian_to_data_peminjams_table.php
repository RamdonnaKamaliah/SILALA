<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('data_peminjams', function (Blueprint $table) {
            // Tambahkan kolom secara berurutan
            if (!Schema::hasColumn('data_peminjams', 'metode_pengembalian')) {
                $table->enum('metode_pengembalian', ['mandiri', 'admin', 'belum_dikembalikan'])
                      ->default('belum_dikembalikan')
                      ->after('keterangan');
            }
            
            if (!Schema::hasColumn('data_peminjams', 'waktu_pengembalian_aktual')) {
                $table->timestamp('waktu_pengembalian_aktual')->nullable()->after('metode_pengembalian');
            }
            
            if (!Schema::hasColumn('data_peminjams', 'foto_bukti_pengembalian')) {
                $table->string('foto_bukti_pengembalian')->nullable()->after('waktu_pengembalian_aktual');
            }
        });
    }

    public function down()
    {
        Schema::table('data_peminjams', function (Blueprint $table) {
            $table->dropColumn([
                'metode_pengembalian',
                'waktu_pengembalian_aktual', 
                'foto_bukti_pengembalian'
            ]);
        });
    }
};