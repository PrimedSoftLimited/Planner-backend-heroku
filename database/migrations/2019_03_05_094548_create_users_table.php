<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('username');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->enum('team_permit', array('hide','show'));
            $table->string('user_image')->default(null);
            $table->string('password');
            $table->string('verify_code', 80)
            ->unique()
            ->nullable()
            ->default(null);
            $table->string('api_token', 80)
            ->unique()
            ->nullable()
            ->default(null);
            $table->string('confirm_token', 80)
            ->unique()
            ->nullable()
            ->default(null);
            $table->enum('status', array('off','on'));
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
        Schema::dropIfExists('users');
    }
}
