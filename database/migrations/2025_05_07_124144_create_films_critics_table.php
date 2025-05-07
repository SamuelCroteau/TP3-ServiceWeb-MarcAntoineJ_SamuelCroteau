<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations. :)
     */
    public function up(): void
    {
        Schema::create('films_critics', function (Blueprint $table) {
            $table->primary(['critic_id', 'film_id']);
            $table->foreignId('critic_id')->constrained();
            $table->foreignId('film_id')->constrained();
            $table->integer('review')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('films_critics');
    }
};
