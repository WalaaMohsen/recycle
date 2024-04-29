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
        Schema::create('antikaes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('status',[0,1])->default(0);
            $table->double('price');
            $table->integer('quantity');
            $table->string('image')->option();
            $table->string('description');
            $table->unsignedBigInteger('subcategory_id');
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');
            $table->rememberToken();
            $table->timestamps();
    });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antikaes');
    }
};
