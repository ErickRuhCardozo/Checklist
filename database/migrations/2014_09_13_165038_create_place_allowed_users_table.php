<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('place_allowed_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('user_type');
            $table->foreignId('place_id')->constrained('places')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('place_allowed_users');
    }
};
