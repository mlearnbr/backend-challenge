<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
       //     $table->string('email')->unique();
       //     $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('msisdn');
            $table->enum('access_level', [ 'free','pro', 'premium'])->default('free');
            $table->string('external_id');
        //    $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
