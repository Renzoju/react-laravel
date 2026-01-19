<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_participant', function (Blueprint $table) {
            $table->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('participant_id')
                ->constrained('participants')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('role')->nullable(); // trekker, partner, deelnemer, etc.

            $table->primary(['project_id', 'participant_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_participant');
    }
};
