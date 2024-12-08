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
        Schema::create('log_pengguna', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('umur');
            $table->string('no_hp');
            $table->string('umkm_name');
            $table->string('provinsi');
            $table->string('kabupaten');
            $table->foreignId('solusi_id')->nullable()->constrained('solusi')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_penggunas');
    }
};
