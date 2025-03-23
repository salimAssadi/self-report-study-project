<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultant_accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->string('name_ar');
            $table->string('name_en')->nullable();
            $table->string('email')->unique();
            $table->string('mobile')->nullable();
            $table->string('address')->nullable();
            $table->string('specialization')->nullable();
            $table->string('signiture')->nullable(); 
            $table->unsignedBigInteger('position_id');
            $table->unsignedBigInteger('user_id');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consultant_accounts');
    }
};
