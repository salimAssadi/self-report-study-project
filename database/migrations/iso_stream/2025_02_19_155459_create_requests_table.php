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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->text('request_type')->nullable();
            $table->text('subject')->nullable();
            $table->text('description')->nullable();
            $table->integer('document_id')->default(0);
            $table->integer('created_by')->default(0);
            $table->integer('processed_by')->nullable();
            $table->dateTime('processed_at')->nullable();
            $table->integer('parent_id')->default(0);
            $table->enum('request_status', ['Pending', 'Processing','Approved','Rejected'])->default('Pending');
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
        Schema::dropIfExists('requests');
    }
};
