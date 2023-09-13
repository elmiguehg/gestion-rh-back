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
        Schema::create('entity_jobtitle', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('entity_id')->nullable();
            $table->unsignedBigInteger('jobtitle_id')->nullable();
            
            $table->foreign('entity_id')->references('id')->on('entities')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('jobtitle_id')->references('id')->on('jobtitles')->onDelete('set null')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entity_jobtitle');
    }
};
