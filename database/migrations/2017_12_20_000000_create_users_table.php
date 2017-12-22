<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned();
            $table->string('name');
            $table->string('google_id');
            $table->string('avatar');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('verifyToken');
            $table->boolean('status');
            $table->boolean('registrationflag');
            $table->rememberToken();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
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
        Schema::dropIfExists('users');


        
    }
}
