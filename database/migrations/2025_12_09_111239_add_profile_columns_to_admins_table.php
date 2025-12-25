<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            if (!Schema::hasColumn('admins', 'telp')) {
                $table->string('telp')->nullable();
            }

            if (!Schema::hasColumn('admins', 'foto')) {
                $table->string('foto')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn(['telp', 'foto']);
        });
    }
};
