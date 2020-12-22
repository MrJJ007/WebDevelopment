<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
//Table setup with values
class CreateMultiPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multi_posts', function (Blueprint $table) {
            $table->id();
            $table->json('users');
            $table->string('content');
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->
			on('users')->onDelete('cascade')->
			onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('multiPosts');
    }
}
