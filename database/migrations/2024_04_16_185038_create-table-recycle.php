<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('recycle', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->rememberToken();
            $table->timestamps();

        });

        
    }
    public function user(){
        return $this->belongsTo(User::class, 'foreign_key');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recycle');
    }
};
