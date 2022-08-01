<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('identification');
            $table->string('address');
            $table->string('phone');
            $table->unsignedBigInteger('id_deparment')->nullable();
            $table->unsignedBigInteger('id_city')->nullable();
            $table->string('city')->nullable();
            $table->string('password')->nullable();
            $table->unsignedBigInteger('id_user_collaborator')->nullable();
            $table->unsignedBigInteger('id_domain_user_type');
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
        Schema::dropIfExists('user');
    }
}
