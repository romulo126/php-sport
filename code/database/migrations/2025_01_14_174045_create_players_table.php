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
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('player_bot_id')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('position')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('jersey_number')->nullable();
            $table->string('college')->nullable();
            $table->string('country')->nullable();
            $table->integer('draft_year')->nullable();
            $table->integer('draft_round')->nullable();
            $table->integer('draft_number')->nullable();
            $table->foreignId('team_id')->constrained('teams')->onDelete('cascade');;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
