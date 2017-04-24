<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->integer('code')->nullable();
            $table->string('reg_no')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('post')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('principal')->nullable();
            $table->string('language')->nullable();
            $table->integer('students')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schools');
    }
}
