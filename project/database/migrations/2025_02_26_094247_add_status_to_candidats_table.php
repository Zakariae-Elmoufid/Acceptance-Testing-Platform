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
        Schema::table('candidats', function (Blueprint $table) {
            $table->boolean('quiz_passed')->default(false);
            $table->integer('quiz_score')->nullable()->after('quiz_passed');
            $table->softDeletes();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidats', function (Blueprint $table) {
            $table->dropColumn('quiz_passed');
            $table->dropColumn('quiz_score');
            $table->dropSoftDeletes();
        });
    }
};
