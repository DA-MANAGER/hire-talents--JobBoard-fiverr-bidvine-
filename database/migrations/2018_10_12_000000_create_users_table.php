<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * @package Hire Talents
 * @author  Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
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
            $table->string('email')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone')->unique()->nullable();
            $table->unsignedInteger('avatar')->nullable();
            $table->date('dob')->comment('Date Of Birth')->nullable();
            $table->string('address')->nullable();
            $table->string('zipcode')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

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
