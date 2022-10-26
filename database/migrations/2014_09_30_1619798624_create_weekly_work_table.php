<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeeklyWorkTable extends Migration
{
	public function up()
	{
		Schema::create('weekly_works', function (Blueprint $table) {

			$table->string('id', 36)->primary();
			$table->string('title', 50);
			$table->string('school_id', 36)->nullable()->default('NULL');
			$table->string('faculty_id', 36);
			$table->string('course_id', 36);
			$table->string('session_id', 36);
			$table->string('date_open', 225);
			$table->string('date_close', 225);
			$table->string('access_code', 225)->nullable()->default('NULL');
			$table->enum('mode', ['0', '1'])->default('1');
			$table->string('limitation', 25)->default('1:30');
			$table->enum('status', ['Active', 'Inactive'])->default('Active');
			$table->rememberToken();
            $table->timestamps();
			$table->foreign('faculty_id')->references('id')->on('faculties');            
            $table->foreign('course_id')->references('id')->on('courses');            
            $table->foreign('session_id')->references('id')->on('sessions');
			
		});
	}

	public function down()
	{
		Schema::disableForeignKeyConstraints();     
		Schema::dropIfExists('weekly_works');
		Schema::enableForeignKeyConstraints();        
	}
}
