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
            //$this->down();
            $table->string('id',36)->primary();
            $table->string('salute',11)->nullable();
            $table->string('first_name');
            $table->string('other_names');
            $table->string('gender')->nullable();
            $table->string('role_id');
            $table->string('email',200)->unique()->nullable();
            $table->string('username');
            $table->string('matric_number')->nullable();
            $table->string('other_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('password');
            $table->string('using_default_password')->nullable();
            $table->string('user_ip_address')->nullable();
            $table->string('faculty_id',36);
            $table->string('school_id',36)->nullable()->default('NULL');
            $table->string('department_id',36);
            $table->string('session_id',36);
            $table->text('token')->nullable();
            $table->text('pages_visited')->nullable();  //pages ever visited          
            $table->enum('user_status', ['0', '1'])->default('0');
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken()->nullable();
            $table->timestamps();
            $table->foreign('role_id')->references('id')->on('roles');                        
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('faculty_id')->references('id')->on('faculties');
            $table->foreign('session_id')->references('id')->on('sessions');
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
        Schema::dropIfExists('users');
        Schema::enableForeignKeyConstraints();        
    }
}
