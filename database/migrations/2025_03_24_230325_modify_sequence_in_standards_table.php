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
        Schema::table('standards', function (Blueprint $table) {
            $table->string('sequence')->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('standards', function (Blueprint $table) {
            $table->integer('sequence')->nullable()->change(); // or whatever the previous type was
        });
    }
};
