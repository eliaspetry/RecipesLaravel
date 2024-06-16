<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->nullable(false);
            $table->enum('difficulty', [
                'easy',
                'medium',
                'hard'
            ]);
            $table->string('author')->nullable(false); // This will just be a dummy text column for now to reduce relational complexity scope, following the assignment
            $table->integer('prep_time_minutes')->nullable(false);
            $table->text('ingredients')->nullable(false);
            $table->text('image_url')->nullable(false);
            $table->mediumText('instructions')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
