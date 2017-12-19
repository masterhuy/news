<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('Users')->insert(
	        [
        		'name' => 'Quang Huy',
            	'email' => 'masterhuy@gmail.com',
            	'password' => bcrypt('123456'),
            	'quyen'=> 1,
            	'created_at' => new DateTime(),
	        ]);
    }
}
