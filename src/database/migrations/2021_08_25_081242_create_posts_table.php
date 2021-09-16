<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
          //  $table->integer('user_id')->unsigned()->index();

            $table->foreignId('user_id')->constrained()->onDelete('cascade'); //if we delete a user from the db, the posts will be deleted too

            $table->text('body');
            $table->timestamps();  //created_at & updated_at columns
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
