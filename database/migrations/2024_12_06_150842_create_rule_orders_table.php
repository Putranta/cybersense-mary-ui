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
        Schema::create('rule_order', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rule_base_id')->constrained('rule_base')->onDelete('cascade');
            $table->foreignId('kriteria_detail_id')->constrained('kriteria_detail')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rule_order');
    }
};
