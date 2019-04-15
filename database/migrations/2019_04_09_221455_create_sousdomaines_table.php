<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSousdomainesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sousdomaines', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nomSousDomaine')->unique();
            $table->timestamps();
            $table->integer('domaine_id')->unsigned()->index();
            $table->engine = 'InnoDB';
        });
        Schema::table('sousdomaines', function (Blueprint $table) {
            $table->foreign('domaine_id')->references('id')->on('domaines')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sousdomaines');
    }
}
