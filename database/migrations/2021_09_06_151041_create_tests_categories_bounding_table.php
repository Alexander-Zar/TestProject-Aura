<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsCategoriesBoundingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('test_id');

            $table->unsignedBigInteger('category_id');

            $table->foreign('test_id')->references('id')->on('tests')

                ->onDelete('cascade');

            $table->foreign('category_id')->references('id')->on('categories')

                ->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_categories');
    }
}
