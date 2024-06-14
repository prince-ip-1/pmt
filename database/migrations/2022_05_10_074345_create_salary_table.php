<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary', function (Blueprint $table) {
            $table->id();
            $table->integer('emp_id');
            $table->date('date');
            $table->integer('month_days');
            $table->integer('working_days');
            $table->integer('lwp');
            $table->integer('pl');
            $table->integer('cl');
            $table->integer('present_days');
            $table->integer('basic_salary');
            $table->integer('professional_tax');
            $table->integer('security_deduction');
            $table->integer('medical_allowance');
            $table->integer('other_allowance');
            $table->integer('leave_travel_allowance');
            $table->integer('pf');
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
        Schema::dropIfExists('salary');
    }
}
