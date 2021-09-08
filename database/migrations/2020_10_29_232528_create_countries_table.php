<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('origin_title');
            $table->string('slug');
            $table->string('code2');
            $table->string('code3');
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('min_lat')->nullable();
            $table->string('max_lat')->nullable();
            $table->string('min_lng')->nullable();
            $table->string('max_lng')->nullable();
            $table->string('language')->nullable();
            $table->string('phone_code')->nullable();
            $table->text('emoji')->nullable();
            $table->text('svg')->nullable();
            $table->text('geo_data')->nullable();
            $table->string('region')->nullable();
            $table->string('subregion')->nullable();
            $table->string('capital')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
