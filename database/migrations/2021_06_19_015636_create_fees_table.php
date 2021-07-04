<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount',8,2);

            $table->unsignedInteger('Grade_id');
            $table->foreign('Grade_id')->references('id')->on('Grades')->onDelete('cascade');
            
            $table->unsignedInteger('Classroom_id');
            $table->foreign('Classroom_id')->references('id')->on('Classrooms')->onDelete('cascade');
           
            // $table->unsignedbigInteger('Fees_Type');
            $table->foreignId('Fees_Type')->references('id')->on('fees_types')->onDelete('cascade');
           
            $table->string('decsription')->nullable();
            $table->string('year');
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
        Schema::dropIfExists('fees');
    }
}
