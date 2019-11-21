<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->integer('id');
            $table->string('name');
            $table->string('nick');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('admin');
            //Crear los campos created_at y updated_at
            $table->timestamps();
            //establecer clave primaria
            $table->primary('id');
            //Campo necesario para el funcionamiento de auth de laravel
            $table->rememberToken();
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
