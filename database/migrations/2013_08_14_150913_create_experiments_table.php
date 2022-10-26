<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperimentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('experiments', function (Blueprint $table) {
            $table->string('id',36)->primary();
            $table->string('name');
//            $table->integer('experiment_number');
            $table->text('experiment_intro');
            $table->string('experiment_goal',1000);
            $table->string('experiment_diagram');
            $table->string('apparatus',1000);
            $table->string('experiment_resource',3000);
            $table->string('procedures', 2000);
            $table->string('exercise', 3000);
            $table->string('required',3000);
            $table->string('video_url');
            $table->string('faculty_id');
            $table->string('page',100);
            $table->enum('tables', ['true', 'false']);
            $table->enum('graph', ['true', 'false']);
            $table->enum('status', ['Active', 'Inactive']);
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
        Schema::dropIfExists('experiments');
    }
}
