<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * @package Hire Talents
 * @author  Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
class CreateServiceQuestionOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_question_options', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('service_question_id');
            $table->string('name');

            $table->timestamps();

            $table->foreign('service_question_id')
                ->references('id')->on('service_questions')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_question_options', function (Blueprint $table) {
            $table->dropForeign(['service_question_id']);
        });

        Schema::dropIfExists('service_question_options');
    }
}
