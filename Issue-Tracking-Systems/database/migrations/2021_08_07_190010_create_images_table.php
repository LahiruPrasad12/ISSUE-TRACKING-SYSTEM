<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('imagable_type');
            $table->string('imagable_id');
            $table->integer('size');
            $table->string('path');
            $table->string('name');
            $table->string('extension');
            $table->bigInteger('issue_id')->unsigned();
            $table->bigInteger('comment_id')->unsigned();
            $table->foreign('issue_id')->references('id')->on('issues')->onDelete('cascade');
            $table->foreign('comment_id')->references('id')->on('comments')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
}
