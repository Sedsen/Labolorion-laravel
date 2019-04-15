<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sous_domaine_id')->unsigned()->index();
            $table->string('nom')->unique();
            $table->integer('prix_vente');
            $table->text('description');
            $table->string('image');
            $table->timestamps();
        });
        Schema::table('produits', function (Blueprint $table) {
            $table->foreign('sous_domaine_id')->references('id')->on('sousdomaines')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produits');
    }
}
