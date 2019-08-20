<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registration', function (Blueprint $table) {
            $table->bigIncrements('reg_id');
            $table->string('reg_email')->unique();
            $table->string('reg_phone')->unique();
            $table->string('reg_firstname');
            $table->string('reg_lastname');
            $table->enum('reg_gender', ['male', 'female'])->nullable();
            $table->date('reg_birthdate')->nullable();
            $table->date('reg_birthmonth')->nullable();
            $table->date('reg_birthyear')->nullable();
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
        Schema::dropIfExists('registration');
    }
}
