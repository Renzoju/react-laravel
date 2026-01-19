<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('relations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('from_participant_id')
                ->constrained('participants')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('to_participant_id')
                ->constrained('participants')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('relation_type_id')
                ->constrained('relation_types')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('relations');
    }
};
