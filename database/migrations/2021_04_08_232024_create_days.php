<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDays extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('days', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer('plan_id')->unsigned()->index();


            $table->string('name');
						$table->text('description');
            $table->integer('sort')->nullable(false);
        });

        Schema::table('days', function (Blueprint $table){
          $table->foreign('plan_id')
            ->references('id')
            ->on('plans');//->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('days');
    }
}
