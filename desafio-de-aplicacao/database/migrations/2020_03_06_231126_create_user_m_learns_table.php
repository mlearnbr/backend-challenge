<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMLearnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_m_learns', function (Blueprint $table) {
            $table->id();
            $table->string('msisdn');
            $table->string('name');
            $table->string('access_level');
            $table->string('password')->nullable();
            $table->string('external_id');
            $table->string('mlearn_id')->nullable();
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
        Schema::dropIfExists('user_m_learns');
    }
}
