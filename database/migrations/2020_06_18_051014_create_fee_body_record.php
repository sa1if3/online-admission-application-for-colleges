<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeeBodyRecord extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_body_record', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->double('fee', 20, 2);
            $table->boolean('checkPWD')->default(0);
            $table->boolean('checkBPL')->default(0);
            $table->unsignedBigInteger('category_record_id');
            $table->unsignedBigInteger('course_record_id');
            $table->unsignedBigInteger('gender_record_id');
            $table->boolean('active')->default(1);
            $table->foreign('gender_record_id')
                ->references('id')->on('gender_record')
                ->onDelete('restrict');

            $table->foreign('category_record_id')
                ->references('id')->on('category_record')
                ->onDelete('restrict');
            $table->foreign('course_record_id')
                ->references('id')->on('course_record')
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
        Schema::dropIfExists('fee_body_record');
    }
}
