<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replies', function (Blueprint $table) {
            $table->increments('id');
			//$table->string('title');
            $table->text('body');
            $table->text('body_original')->nullable();
			$table->text('credentials');
            $table->integer('user_id');
            $table->integer('thread_id');
			 $table->boolean('is_block')->default(false);
			 $table->integer('like_count')->default(0);
            
            $table->date('created_at');
            $table->date('updated_at');
            
            
			
			
			
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
        Schema::drop('replies');
    }
}
