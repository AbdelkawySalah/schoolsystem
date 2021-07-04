<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');

            $table->unsignedInteger('from_gradeid');
            $table->unsignedInteger('from_Classroomid');
            $table->unsignedBigInteger('from_sectionid');
            $table->string('academic_year');

            $table->unsignedInteger('to_gradeid');
            $table->unsignedInteger('to_Classroomid');
            $table->unsignedBigInteger('to_sectionid');
            $table->string('academic_year_new');

            $table->timestamps();
        });

        Schema::table('promotions', function (Blueprint $table) {
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');

            $table->foreign('from_gradeid')->references('id')->on('Grades')->onDelete('cascade');
            $table->foreign('from_Classroomid')->references('id')->on('Classrooms')->onDelete('cascade');
            $table->foreign('from_sectionid')->references('id')->on('sections')->onDelete('cascade');

            $table->foreign('to_gradeid')->references('id')->on('Grades')->onDelete('cascade');
            $table->foreign('to_Classroomid')->references('id')->on('Classrooms')->onDelete('cascade');
            $table->foreign('to_sectionid')->references('id')->on('sections')->onDelete('cascade');


        });


    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotions');
    }
}
