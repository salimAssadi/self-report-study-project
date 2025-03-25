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
        Schema::create('standards', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('main'); // 'main' or 'sub'
            $table->foreignId('parent_id')->nullable()->constrained('standards')->onDelete('cascade'); // Self-referencing for sub-standards
            $table->integer('sequence')->nullable();
            $table->string('name_ar')->nullable();
            $table->string('name_en')->nullable();
            $table->text('introduction_ar')->nullable();
            $table->text('introduction_en')->nullable();
            $table->longText('description_ar')->nullable();
            $table->longText('description_en')->nullable();
            $table->longText('summary_ar')->nullable();
            $table->longText('summary_en')->nullable();
            $table->string('completion_status')->default('incomplete'); // Possible values: 'incomplete', 'partially_completed', 'completed'
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('standards');
    }
};
