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
            Schema::table('classes', function (Blueprint $table) {
                $table->unsignedBigInteger('enseignant_id')->nullable();

                // Si l'enseignant est une clé étrangère
                $table->foreign('enseignant_id')->references('id')->on('enseignants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('classes', function (Blueprint $table) {
            $table->dropForeign(['enseignant_id']);
            $table->dropColumn('enseignant_id');
        });
    }
};
