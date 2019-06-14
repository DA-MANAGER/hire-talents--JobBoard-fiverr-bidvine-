<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * @package Hire Talents
 * @author  Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
class CreateBidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bids', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description');
            $table->float('amount');
            $table->unsignedInteger('business_id');
            $table->unsignedInteger('service_request_id');

            $table->timestamps();

            $table->foreign('business_id')
                ->references('id')->on('businesses')
                ->onDelete('cascade');

            $table->foreign('service_request_id')
                ->references('id')->on('service_requests')
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
        Schema::table('bids', function (Blueprint $table) {
            $table->dropForeign(['business_id']);
            $table->dropForeign(['service_request_id']);
        });

        Schema::dropIfExists('bids');
    }
}
