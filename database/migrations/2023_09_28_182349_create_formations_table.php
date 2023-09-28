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
        Schema::create('formations', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->timestamp("duration"); // Durée
            $table->text("description"); // Desccription de la formation
            $table->text("target_audience"); // Public ciblé
            $table->text("to_learn"); // Que vais-je apprendre
            $table->text("prerequisites"); // Prérequis
            $table->text("included"); // Matériels inclus
            $table->string("labels");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formations');
    }
};
