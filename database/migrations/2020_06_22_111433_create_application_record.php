<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationRecord extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_record', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('application_id')->unique()->nullable();
            $table->boolean('status')->default(0);
            $table->unsignedBigInteger('course_record_id');
            $table->unsignedInteger('student_id');
            $table->string('name');
            $table->date('dob')->nullable();
            $table->unsignedBigInteger('gender_record_id')->nullable();
            $table->unsignedBigInteger('caste_record_id')->nullable();
            $table->unsignedBigInteger('religion_record_id')->nullable();
            $table->string('nationality')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('pincode')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_occupation')->nullable();
            $table->string('father_contact')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->string('mother_contact')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('guardian_occupation')->nullable();
            $table->string('guardian_contact')->nullable();
            $table->unsignedBigInteger('hs_board_record_id')->nullable();
            $table->string('hs_pass_year')->nullable();
            $table->string('hs_division')->nullable();
            $table->integer('hs_percentage')->nullable();
            $table->unsignedBigInteger('hslc_board_record_id')->nullable();
            $table->string('hslc_pass_year')->nullable();
            $table->string('hslc_division')->nullable();
            $table->integer('hslc_percentage')->nullable();     
            $table->string('file_photo')->nullable();
            $table->string('file_signature')->nullable();
            $table->string('file_hs')->nullable();
            $table->string('file_hslc')->nullable();
            $table->string('file_dob')->nullable();
            $table->string('file_caste')->nullable();
            $table->boolean('checkPWD')->default(0);
            $table->boolean('checkBPL')->default(0);
            $table->string('major',500)->nullable();
            $table->string('elective',500)->nullable();
            $table->integer('complete_percentage')->default(10);
            $table->foreign('course_record_id')
                ->references('id')->on('course_record')
                ->onDelete('restrict');

            $table->foreign('student_id')
                ->references('id')->on('students')
                ->onDelete('cascade');

            $table->foreign('gender_record_id')
                ->references('id')->on('gender_record')
                ->onDelete('restrict');
            $table->foreign('caste_record_id')
                ->references('id')->on('category_record')
                ->onDelete('restrict');
            $table->foreign('religion_record_id')
                ->references('id')->on('religion_record')
                ->onDelete('restrict');
            $table->foreign('hs_board_record_id')
                ->references('id')->on('board_record')
                ->onDelete('restrict');
            $table->foreign('hslc_board_record_id')
                ->references('id')->on('board_record')
                ->onDelete('restrict');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('application_record');
    }
}
