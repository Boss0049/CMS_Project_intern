<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('post', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('title');
            $table->string('keywords');
            $table->string('description',140);
            $table->longtext('content');
            $table->datetime('datetime');
            $table->longtext('cover');
            $table->enum('status',array('private', 'public','delete'));
            $table  ->Integer('id_name')->unsigned();
            $table  ->foreign('id_name')
                    ->references('id')
                    ->on('article')
                    ->onDeletes('cascade')
                    ->onUpdate('cascade');
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
        Schema::dropIfExists('post');
    }
}
