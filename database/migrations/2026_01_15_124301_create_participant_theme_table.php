<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('participant_theme', function (Blueprint $table) {
            $table->foreignId('participant_id')
                ->constrained('participants')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('theme_id')
                ->constrained('themes')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->primary(['participant_id', 'theme_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('participant_theme');
    }
};
