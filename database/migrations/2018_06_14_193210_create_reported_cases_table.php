<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportedCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reported_cases', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title', 300);

            $table->unsignedInteger('student_id')->index();
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedInteger('location_id')->nullable();
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('set null');

            $table->boolean('solved')->default(false);

            $table->boolean('anonymous')->default(false);

            $table->enum('category', config("exclamo.categories", ["other"]));

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
        Schema::dropIfExists('reported_cases');
    }
}
