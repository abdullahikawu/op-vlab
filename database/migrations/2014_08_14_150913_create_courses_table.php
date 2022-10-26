<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->string('id',36)->primary();
            $table->string('school_id',36);
            $table->string('faculty_id',36);
            $table->string('session_id',36);
            $table->string('enrollment_code')->nullable();
            $table->string('title');
            $table->string('code');
            $table->string('video_url')->nullable();
            $table->string('description',3000);
            $table->enum('status', ['Active', 'Inactive']);
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('faculty_id')->references('id')->on('faculties');
            $table->foreign('session_id')->references('id')->on('sessions');
        });

        Schema::create('user_courses', function (Blueprint $table) {
            $table->string('id',36)->primary();
            $table->string('school_id',36);
            $table->string('faculty_id',36);
            $table->string('course_id',36);
            $table->string('user_id',36);
            $table->string('session_id',36);
            $table->enum('status', ['Active', 'Inactive']);
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('faculty_id')->references('id')->on('faculties');
            $table->foreign('course_id')->references('id')->on('courses');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('session_id')->references('id')->on('sessions');
        });

        Schema::create('course_experiment', function (Blueprint $table) {
            $table->string('id',36)->primary();
            $table->string('course_id',36);
            $table->string('experiment_id',36);
            $table->enum('status', ['Active', 'Inactive']);
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('course_id')->references('id')->on('courses');
            $table->foreign('experiment_id')->references('id')->on('experiments');
        });

        Schema::create('course_resources', function (Blueprint $table) {
            $table->string('id',36)->primary();
            $table->string('course_id',36);
            $table->string('resourceUrl')->nullable();
            $table->string('caption')->nullable();
            $table->enum('status', ['Active', 'Inactive']);
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('course_id')->references('id')->on('courses');
        });

        Schema::create('course_instructor', function (Blueprint $table) {
            $table->string('id',36)->primary();
            $table->string('course_id',36);
            $table->string('user_id',36);
            $table->enum('status', ['Active', 'Inactive']);
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('course_id')->references('id')->on('courses');
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('courses');
        Schema::dropIfExists('user_courses');
        Schema::dropIfExists('course_experiment');
        Schema::dropIfExists('course_resources');
        Schema::dropIfExists('course_instructor');        
        Schema::enableForeignKeyConstraints();        
        
    }
}
