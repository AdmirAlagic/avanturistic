<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPostUserIdToPostVisitedsLikes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post_visiteds', function (Blueprint $table) {
            $table->integer('post_user_id')->nullable();
        });
        Schema::table('post_likes', function (Blueprint $table) {
            $table->integer('post_user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_visiteds', function (Blueprint $table) {
            $table->dropColumn('post_user_id');
        });
        Schema::table('post_likes', function (Blueprint $table) {
            $table->integer('post_user_id')->nullable();
        });
    }
}
