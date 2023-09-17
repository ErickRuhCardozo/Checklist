<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('password');
            $table->unsignedTinyInteger('type');
            $table->unsignedTinyInteger('work_period');
            $table->foreignId('unity_id')->constrained('unities')->cascadeOnUpdate()->cascadeOnDelete();
            $table->rememberToken();
            $table->unique(['name', 'unity_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
