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
        Schema::create('team_game_stats', function (Blueprint $table) {
        $table->id();
        $table->foreignId('team_id')->constrained('makifespors')->onDelete('cascade');
        $table->string('game');
        $table->integer('puan')->default(0);
        $table->integer('galibiyet')->default(0);
        $table->integer('beraberlik')->default(0);
        $table->integer('maglubiyet')->default(0);
        $table->timestamps();
        $table->softDeletes();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_game_stats');
    }
};
