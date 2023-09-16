<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedTinyInteger('period');
            $table->foreignId('place_id')->constrained('places')->cascadeOnUpdate()->cascadeOnUpdate();
            $table->unique(['title', 'place_id', 'period']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
