<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('avatar');
            $table->string('email')->nullable()->index();
            $table->string('name')->nullable()->index();
            $table->integer('github_id')->index();
            $table->string('github_url');
            $table->string('github_name')->index();
            $table->string('real_name')->nullable();
            $table->string('remember_token')->nullable();
            $table->boolean('is_banned')->default(false)->index();
            $table->string('image_url')->nullable();
            $table->integer('topic_count')->default(0)->index();
            $table->integer('reply_count')->default(0)->index();
            $table->string('city')->nullable();
            $table->string('company')->nullable();
            $table->string('twitter_account')->nullable();
            $table->string('personal_website')->nullable();
            $table->string('signature')->nullable();
            $table->string('introduction')->nullable();
            $table->integer('notification_count')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('users');
    }
}
