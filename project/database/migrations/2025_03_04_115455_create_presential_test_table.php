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
        Schema::create('presential_test', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['coach', 'cme', 'administrativ']);
            $table->foreignId('candidat_id')->constrained()->onDelete('cascade');
            $table->dateTime ('date_start');
            $table->dateTime ('date_end');
            $table->string('location');
            $table->foreignId('staff_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presential_test');
    }
};
