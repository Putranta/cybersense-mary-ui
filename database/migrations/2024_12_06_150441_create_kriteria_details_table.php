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
        Schema::create('kriteria_detail', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 6)->unique();
            $table->string('name', 100);
            $table->string('desc', 255)->nullable();
            $table->foreignId('kriteria_id')->constrained('kriteria')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kriteria_detail');
    }
};
