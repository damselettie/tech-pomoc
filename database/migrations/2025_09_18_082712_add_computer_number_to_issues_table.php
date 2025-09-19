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
        $table->string('computer_number')->nullable(); // pole na nr komputera, może być null
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::table('issues', function (Blueprint $table) {
        $table->dropColumn('computer_number');
    });
    }
};
