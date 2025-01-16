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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('game_bot_id')->nullable();
            $table->date('date');
            $table->integer('season');
            $table->string('status')->nullable();
            $table->integer('period')->nullable();
            $table->string('time')->nullable();
            $table->boolean('postseason')->nullable();
            $table->integer('home_team_score')->nullable();
            $table->integer('visitor_team_score')->nullable();
            $table->foreignId('home_team_id')->constrained('teams')->onDelete('cascade');;
            $table->foreignId('visitor_team_id')->constrained('teams')->onDelete('cascade');;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
