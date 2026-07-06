<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->String('offer_name');
            $table->date('from_date');
            $table->date('to_date');
            $table->String('offer_status');
            $table->String('no_of_videos');
            $table->String('no_of_images');
            $table->String('validity');
            $table->String('noofmblno');
            $table->String('specification_3');
            $table->String('specification_4');
            $table->String('specification_5');
            $table->String('specification_6');
            $table->String('specification_7');
            $table->String('specification_8');
            $table->String('specification_9');
            $table->String('specification_10');
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
        Schema::dropIfExists('offers');
    }
}

