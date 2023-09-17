<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('checklist_id')->constrained('checklists')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('place_id')->constrained('places')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('worker');
            $table->string('observations')->nullable();
            $table->timestamps();
            $table->unique(['checklist_id', 'place_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scans');
    }
};
