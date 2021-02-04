<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('learningarea');
            $table->string('gradelevel');
            $table->string('author');
            $table->string('publisher');
            $table->string('lrtype');
            $table->date('acquisitiondate');
            $table->string('acquisitionmode');
            $table->unsignedBigInteger('copies');
            $table->string('status');
            $table->unsignedBigInteger('schoolyear');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventories');
    }
}
