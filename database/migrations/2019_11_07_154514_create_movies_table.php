<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->integer('id');
            $table->string('title');
            $table->text('sinopsis');
            $table->integer('duration');
            $table->integer('year');
            $table->float('rating');
            $table->string('filepath');
            $table->string('filename');
            $table->string('poster')->nullable();
            //Crear los campos created_at y updated_at
            $table->timestamps();
            //establecer clave primaria
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
