<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * @package Hire Talents
 * @author  Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
class CreateServiceQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('service_id');
            $table->string('question');
            $table->string('visibility_type')->default('radio');

            $table->timestamps();

            $table->foreign('service_id')
                ->references('id')->on('services')
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
        Schema::table('service_questions', function (Blueprint $table) {
            $table->dropForeign(['service_id']);
        });

        Schema::dropIfExists('service_questions');
    }
}
