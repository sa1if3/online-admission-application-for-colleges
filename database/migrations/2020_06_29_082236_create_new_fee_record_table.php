<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewFeeRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_fee_record', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('fee_name');
            $table->integer('fee_year')->default(0);
            /*Default 0 means that it is for application fees not for any year or semester*/
            $table->integer('gen');
            $table->integer('sc');
            $table->integer('st');
            $table->integer('obc');
            $table->integer('pwd');
            $table->integer('bpl');
            $table->boolean('active')->default(1); 
            $table->unsignedBigInteger('course_record_id');
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
        Schema::dropIfExists('new_fee_record');
    }
}
