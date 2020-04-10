<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SubjectClassroom extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_classroom', function (Blueprint $table) {
            
            $table->increments('SC_ID');
            $table->integer('FK_Classroom')->unsigned();
            $table->integer('FK_Subject')->unsigned();
            $table->foreign('FK_Classroom')->references('Classroom_ID')->on('classrooms');
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
