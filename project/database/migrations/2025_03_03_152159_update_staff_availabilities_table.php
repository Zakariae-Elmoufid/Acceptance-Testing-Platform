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
        Schema::table('staff_availabilities', function (Blueprint $table) {
            $table->dropColumn('day_of_week');
            $table->dropColumn('is_available');
            $table->dateTime('start_time')->change();
            $table->dateTime('end_time')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('staff_availabilities', function (Blueprint $table) {
                        $table->enum('day_of_week', ['monday', 'tuesday', 'wednesday', 'thursday', 'friday']);
                        $table->time('start_time')->change();
                        $table->time('end_time')->change();
        });
    }
};
