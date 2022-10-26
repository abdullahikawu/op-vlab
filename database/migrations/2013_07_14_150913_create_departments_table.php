<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->string('id')->primary();            
            $table->string('faculty_id');
            $table->string('name');
            $table->string('code');
            $table->enum('status', ['Active', 'Inactive']);
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('faculty_id')->references('id')->on('faculties');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();     
        Schema::dropIfExists('departments');
        Schema::enableForeignKeyConstraints();        
    }
}

