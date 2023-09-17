<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('qrcode')->unique();
            $table->foreignId('unity_id')->constrained('unities')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['name', 'unity_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('places');
    }
};
