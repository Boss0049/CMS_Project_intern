<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms', function (Blueprint $table) {
            $table->Integer('ID_post')->unsigned();
            $table  ->foreign('ID_post')
                    ->references('id')
                    ->on('post')
                    ->onDeletes('cascade')
                    ->onUpdate('cascade');
            $table->Integer('ID_users')->unsigned();
            $table  ->foreign('ID_users')
                    ->references('id')
                    ->on('users')
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
        Schema::dropIfExists('cms');
    }
}
