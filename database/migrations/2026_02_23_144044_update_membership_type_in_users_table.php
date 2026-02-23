<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Ubah data lama
        DB::table('users')
            ->where('membership_type', 'karyawan')
            ->update(['membership_type' => 'pengunjung']);

        DB::table('users')
            ->where('membership_type', 'magang')
            ->update(['membership_type' => 'anggota']);

        // 2. Ubah enum
        DB::statement("ALTER TABLE users MODIFY membership_type ENUM('pengunjung', 'anggota') DEFAULT 'pengunjung'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Balikkan data
        DB::table('users')
            ->where('membership_type', 'pengunjung')
            ->update(['membership_type' => 'karyawan']);

        DB::table('users')
            ->where('membership_type', 'anggota')
            ->update(['membership_type' => 'magang']);

        // Balikkan enum
        DB::statement("ALTER TABLE users MODIFY membership_type ENUM('karyawan', 'magang') DEFAULT 'karyawan'");
    }
};