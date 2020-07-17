<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    public function up(){
      Schema::create('groups', function (Blueprint $table) {
        $table->integer('id')->autoIncrement();
        $table->string('group_id', 5)->unique();
        $table->string('title', 20);

        $table->integer('user_id');
        $table->foreign('user_id')
        ->on('users')
        ->references('id')
        ->OnDelete('cascade');

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
        Schema::dropIfExists('groups');
    }
}
