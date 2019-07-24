<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscussionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discussions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('chat_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->boolean('is_doc')->nullable();
            $table->boolean('is_image')->nullable();
            $table->timestamps();
        });

        Schema::table('discussions', function(Blueprint $table) {
            $table->foreign('chat_id')->references('id')->on('chats')->onDelete('restrict');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discussions');
    }
}
