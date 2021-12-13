<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEnableFlag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profile_mails', function (Blueprint $table) {
            $table->boolean('is_enable')->default(true);
        });
        Schema::table('profile_telephones', function (Blueprint $table) {
            $table->boolean('is_enable')->default(true);
        });
        Schema::table('profile_telegrams', function (Blueprint $table) {
            $table->boolean('is_enable')->default(true);
        });
        Schema::table('profile_vks', function (Blueprint $table) {
            $table->boolean('is_enable')->default(true);
        });
        Schema::table('profile_whatsapps', function (Blueprint $table) {
            $table->boolean('is_enable')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profile_mails', function (Blueprint $table) {
            $table->dropColumn('is_enable');
        });
        Schema::table('profile_telephones', function (Blueprint $table) {
            $table->dropColumn('is_enable');
        });
        Schema::table('profile_telegrams', function (Blueprint $table) {
            $table->dropColumn('is_enable');
        });
        Schema::table('profile_vks', function (Blueprint $table) {
            $table->dropColumn('is_enable');
        });
        Schema::table('profile_whatsapps', function (Blueprint $table) {
            $table->dropColumn('is_enable');
        });
    }
}
