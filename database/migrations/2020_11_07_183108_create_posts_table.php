<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
//Table setup with values
class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('user');
            $table->string('content');
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->string('post_image')->nullable();
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
        Schema::dropIfExists('posts');
    }
}
