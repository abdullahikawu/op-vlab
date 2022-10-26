<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $uuids = json_decode(json_encode(config('calculations.default_uuids')));
    	 
    	 DB::table('sessions')->insert([
    	 	'id'=> $uuids->session_id,
    	 	'session'=>'2020/2021',
    	 	'is_current'=>'1'
    	 ]);
        //
    }
}
?>