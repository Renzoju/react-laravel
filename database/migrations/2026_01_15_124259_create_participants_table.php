<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('short_description')->nullable();

            $table->foreignId('participant_type_id')
                ->constrained('participant_types')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('layer_id')
                ->constrained('layers')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('website')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
