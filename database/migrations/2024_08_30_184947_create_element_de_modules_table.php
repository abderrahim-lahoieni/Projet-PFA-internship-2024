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
        Schema::create('element_de_modules', function (Blueprint $table) {
            $table->id();
            $table->integer('volumeHoraire');
            $table->string('libelle');
            $table->foreignId('module_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('enseignant_id')
                ->constrained() // Specify the correct table name for the foreign key
                ->onDelete('cascade');
            $table->foreignId('salle_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string('jour');
            $table->string('periode');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('element_de_modules');
    }
};
