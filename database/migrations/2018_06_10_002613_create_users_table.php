<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->index('id');

            $table->string('first_name');
            $table->string('last_name');

            $table->string('email')->unique();
            $table->index('email');

            $table->string('password');
            
            $table->unsignedInteger('school_id')->nullable();
            $table->index('school_id');
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');
            
            $table->boolean('mentoring')->default(false);

            $table->longText('notes')->nullable();

            $table->string('language')->default(config('app.locale'));

            $table->rememberToken();
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
