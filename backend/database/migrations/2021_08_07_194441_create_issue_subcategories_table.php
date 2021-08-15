<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssueSubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issue__subcategories', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('subcat_id')->unsigned();
            $table->bigInteger('issue_id')->unsigned();

            $table->foreign('subcat_id')->references('id')->on('subcategories')->onDelete('cascade');
            $table->foreign('issue_id')->references('id')->on('issues')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('issue__subcategories');
    }
}
