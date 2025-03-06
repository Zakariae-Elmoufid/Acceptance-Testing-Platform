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
        Schema::table('test_groups', function (Blueprint $table) {
        $table->integer('occupied')->change();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
    }
};
