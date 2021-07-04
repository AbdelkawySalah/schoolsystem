<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_accounts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')->references('id')->on('students')->onDelete('cascade');
           
            $table->date('move_date');
            $table->string('type');
//ممكن يدخل في حساب العميل فاتورة او سند قيض 
            $table->foreignId('fee_invoiceid')->nullable()->references('id')->on('fee_invoices')->onDelete('cascade');
            $table->foreignId('receipt_id')->nullable()->references('id')->on('receipt_students')->onDelete('cascade');

            //المعالجة المحاسبية في حالة ان طالب مثلا مش هيسدد باقي مبلغ وعاوز يمشي
            $table->foreignId('processing_id')->nullable()->references('id')->on('processing_fees')->onDelete('cascade');

            $table->decimal('Debit',8,2)->nullable();
            $table->decimal('credit',8,2)->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('student_accounts');
    }
}
