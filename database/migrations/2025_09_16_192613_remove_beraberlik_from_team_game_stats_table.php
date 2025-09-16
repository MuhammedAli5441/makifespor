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
         Schema::table('team_game_stats', function (Blueprint $table) {
        if (Schema::hasColumn('team_game_stats', 'beraberlik')) {
            $table->dropColumn('beraberlik');
        }
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
          Schema::table('team_game_stats', function (Blueprint $table) {
        $table->integer('beraberlik')->default(0)->after('galibiyet');
    });
    }
};
