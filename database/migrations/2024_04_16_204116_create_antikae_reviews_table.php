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
        Schema::create('antikae_reviews', function (Blueprint $table) {
            $table->id();
            $table->enum('value',[1,2,3,4,5]);
            $table->string('comment');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('antikae_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('antikae_id')->references('id')->on('antikaes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antikae_reviews');
    }
};
