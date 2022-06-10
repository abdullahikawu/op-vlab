<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * 
     */    
    private $token = "x";
    public function test_testing_Login(){
        //$this->withoutExceptionHandling();
        $response = $this->Json('POST','api/login',['username'=>'admin@vlab.com', 'password'=>'12345678']);        
        $response->assertStatus(200);
     
    //    $this->token = $response['access_token'];
    }

    public function test_testing_Login_with_no_data(){
        $response = $this->Json('POST','api/login',['username'=>'', 'password'=>'']);                    
        $response->assertStatus(400);
    }

    public function test_testing_Login_with_wrong_data(){
        $response = $this->Json('POST','api/login',['username'=>'admin@vlab.com', 'password'=>'1234x']);                    
        $response->assertStatus(200);
    }

    public function test_Store(){     
        $this->withoutExceptionHandling();
 
        $response = $this->Json('POST','api/users/create',['email'=>'admin1@vlab.com', 'first_name'=>'12345678','faculty_id'=>'122134','department_id'=>'sdkjhuiw2323', 'role_id'=>'237963297238739']);        
        $response->assertStatus(200);                
    }

}
