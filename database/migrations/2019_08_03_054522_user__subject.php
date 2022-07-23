<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserSubject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_subject', function (Blueprint $table) {

            $table->increments('US_ID');
            $table->unsignedInteger('FK_User');
            $table->unsignedInteger('FK_Subject');
            $table->foreign('FK_User')->references('user_id')->on('users');
            $table->foreign('FK_Subject')->references('Subject_ID')->on('subjects');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_subject');
    }
}
