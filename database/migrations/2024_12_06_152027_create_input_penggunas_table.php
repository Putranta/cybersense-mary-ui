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
        Schema::create('input_penggunas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('log_pengguna_id')->constrained('log_pengguna')->onDelete('cascade');
            $table->foreignId('kriteria_detail_id')->constrained('kriteria_detail')->onDelete('cascade');
            $table->integer('value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('input_penggunas');
    }
};
