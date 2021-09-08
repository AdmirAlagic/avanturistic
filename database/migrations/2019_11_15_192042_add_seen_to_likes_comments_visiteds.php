<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSeenToLikesCommentsVisiteds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->tinyInteger('seen')->default(0);
        });
        Schema::table('post_visiteds', function (Blueprint $table) {
            $table->tinyInteger('seen')->default(0);
        });
        Schema::table('post_likes', function (Blueprint $table) {
            $table->tinyInteger('seen')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropColumn('seen');
        });
        Schema::table('post_visiteds', function (Blueprint $table) {
            $table->dropColumn('seen');
        });
        Schema::table('post_likes', function (Blueprint $table) {
            $table->dropColumn('seen');
        });
    }
}
