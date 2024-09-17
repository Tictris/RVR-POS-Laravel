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
        Schema::create('booked_cottages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('entrance_id');
            $table->foreign('entrance_id')->references('id')->on('entrances')->onDelete('cascade');
            $table->unsignedBigInteger('cottage_id');
            $table->foreign('cottage_id')->references('id')->on('cottages')->onDelete('cascade');
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booked_cottages');
    }
};
