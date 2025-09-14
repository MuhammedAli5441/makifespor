<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('makifespors', function (Blueprint $table) {
        $table->json('oyunlar')->nullable()->after('gecmis');
    });
}


    /**
     * Reverse the migrations.
     */
 public function down()
{
    Schema::table('makifespors', function (Blueprint $table) {
        $table->dropColumn('oyunlar');
    });
}

};
