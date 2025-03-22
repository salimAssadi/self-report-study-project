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
        Schema::create('criteria', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('standard_id');
            $table->enum('standard_type', ['main', 'sub'])->default('main');
            $table->string('name_ar')->nullable();
            $table->string('name_en')->nullable();
            $table->text('content_ar')->nullable();
            $table->text('content_en')->nullable();
            $table->boolean('is_met')->default(false);
            $table->integer('fulfillment_status')->nullable()->unsigned();
            $table->string('completion_status')->nullable();

            $table->index(['standard_id', 'standard_type']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('criteria');
    }
};
