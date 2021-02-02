<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('action');
            $table->text('data');
            $table->unsignedBigInteger('content_id');
            $table->unsignedBigInteger('user_id');     
            $table->timestamps();

            $table->index('content_id');
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
        Schema::dropIfExists('content_logs');
    }
}
