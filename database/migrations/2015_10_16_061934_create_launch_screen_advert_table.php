<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaunchScreenAdvertTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('launch_screen_adverts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->string('image_large');
            $table->string('image_small');
            $table->string('type', 10)->index();
            $table->string('payload');
            $table->tinyInteger('display_time')->default(3);
            $table->timestamp('start_at');
            $table->timestamp('expires_at')->index();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('launch_screen_adverts');
    }
}
