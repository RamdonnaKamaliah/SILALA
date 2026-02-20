<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('admins', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('phone')->nullable();
        $table->string('email')->unique();
        $table->enum('membership_type', ['karyawan', 'magang'])->nullable();
        $table->enum('gender', ['L', 'P'])->nullable();
        $table->timestamp('email_verified_at')->nullable();
        $table->string('password');
        $table->string('google_id')->nullable();
        $table->string('google_token')->nullable();
        $table->string('google_refresh_token')->nullable();
        $table->rememberToken();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
