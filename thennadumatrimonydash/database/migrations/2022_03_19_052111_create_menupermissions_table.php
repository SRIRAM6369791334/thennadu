<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenupermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menupermissions', function (Blueprint $table) {
            $table->id();
            $table->integer('menu_no');
            $table->String('mainmenu');
            $table->String('menu');
            $table->String('menu_type');
            $table->String('menulink');
            $table->String('menuicon');
            $table->String('menuopen');
            $table->String('menuactive');
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
        Schema::dropIfExists('menupermissions');
    }
}

