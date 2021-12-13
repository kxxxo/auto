<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProfileAndProfileVk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_vks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('external_id');
            $table->text('access_token');
            $table->text('email');
            $table->timestamps();
        });
        Schema::create('profile_telegrams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('external_id');
            $table->text('first_name');
            $table->text('last_name');
            $table->text('username');
            $table->text('photo_url');
            $table->timestamps();
        });
        Schema::create('profile_telephones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('external_id');
            $table->timestamps();
        });
        Schema::create('profile_whatsapps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('external_id');
            $table->timestamps();
        });
        Schema::create('profile_mails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('external_id');
            $table->timestamps();
        });

        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('profile_vk_id')->nullable()->unique();
            $table->integer('profile_telegram_id')->nullable()->unique();
            $table->integer('profile_telephone_id')->nullable()->unique();
            $table->integer('profile_whatsapp_id')->nullable()->unique();
            $table->integer('profile_email_id')->nullable()->unique();
            $table->timestamps();

            $table->foreign('profile_vk_id')->references('id')->on('profile_vks');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('profile_telegram_id')->references('id')->on('profile_telegrams');
            $table->foreign('profile_telephone_id')->references('id')->on('profile_telephones');
            $table->foreign('profile_whatsapp_id')->references('id')->on('profile_whatsapps');
            $table->foreign('profile_email_id')->references('id')->on('profile_mails');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('profiles');
        Schema::drop('profile_vks');
        Schema::drop('profile_telegrams');
        Schema::drop('profile_telephones');
        Schema::drop('profile_whatsapps');
        Schema::drop('profile_mails');
    }
}
