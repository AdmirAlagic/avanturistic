<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::table('posts', function (Blueprint $table) {
            $table->index('created_at');
        });
        Schema::table('users', function (Blueprint $table) {

            $table->index('name');
            $table->index('country_code');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('posts', function (Blueprint $table) {

            $table->dropIndex('created_at');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex('country_code');
            $table->dropIndex('created_at');
        });
    }
}
