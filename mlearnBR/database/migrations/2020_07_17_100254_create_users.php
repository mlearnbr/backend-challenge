<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsers extends Migration
{
    public function up(){
      Schema::create('users', function (Blueprint $table) {
        $table->integer('id')->autoIncrement();
        $table->string('name', 50);
        $table->string('msisdn', 12)->nullable();       
        
        $table->string('access_level')
        ->enum(['free', 'premium']);
        
        $table->string('password');        

        $table->timestamps();
      });
    }

    public function down(){
      Schema::dropIfExists('users');
    }
}
