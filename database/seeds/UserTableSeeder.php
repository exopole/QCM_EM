<?php

use Illuminate\Database\Seeder;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 50)->create();

        DB::table('users')->insert([
	            'username' => 'teacher',
		        'password' => bcrypt('secret'),
		        'role' => 'teacher', 
		        'remember_token' => str_random(10),
        	]);

        DB::table('users')->insert([
	            'username' => 'studentfirst',
		        'password' => bcrypt('secret'),
		        'role' => 'first_class', 
		        'remember_token' => str_random(10),
        	]);

        DB::table('users')->insert([
	            'username' => 'studentfinal',
		        'password' =>  bcrypt('secret'),
		        'role' => 'final_class', 
		        'remember_token' => str_random(10),
        	]);
        
    }

    
}
