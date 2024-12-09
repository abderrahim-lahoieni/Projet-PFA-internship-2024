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
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->integer('volumeHoraire');
            $table->foreignId('classe_id')->constrained()->onDelete('cascade'); // Relation avec la classe
            $table->foreignId('semestre_id')->constrained()->onDelete('cascade'); // Relation avec la classe
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
