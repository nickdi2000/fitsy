<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDayExercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('day_exercises', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('day_id');
            $table->integer('exercise_id');
            $table->text('note')->nullable();
            $table->integer('order')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('day_exercises');
    }
}
