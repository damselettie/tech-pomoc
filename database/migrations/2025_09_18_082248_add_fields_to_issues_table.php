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
  Schema::table('issues', function (Blueprint $table) {
    if (!Schema::hasColumn('issues', 'description')) {
        $table->text('description')->nullable();
    }
    if (!Schema::hasColumn('issues', 'room_number')) {
        $table->string('room_number');
    }
});

    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
Schema::table('issues', function (Blueprint $table) {
    if (!Schema::hasColumn('issues', 'description')) {
        $table->text('description')->nullable();
    }
    if (!Schema::hasColumn('issues', 'room_number')) {
        $table->string('room_number');
    }
});

    }
};
