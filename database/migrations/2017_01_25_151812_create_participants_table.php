<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->integer('student_id')->unsigned();
            $table->integer('olympiad_id')->unsigned();
            $table->integer('room_id')->unsigned()->nullable();
            $table->timestamp('start')->nullable();
            $table->timestamp('finish')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->primary(['student_id', 'olympiad_id']);

            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('olympiad_id')->references('id')->on('olympiads')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participants');
    }
}
