<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssueCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issue__categories', function (Blueprint $table) {
            $table->id();
            $table->integer('issue_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->foreign('issue_id')->references('id')->on('issues');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('issue__categories');
    }
}
