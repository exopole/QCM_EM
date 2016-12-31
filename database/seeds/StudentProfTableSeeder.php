<?php

use Illuminate\Database\Seeder;
use App\User;

class StudentProfTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$users = User::all();

        $teachers=[];
        $students=[];

        foreach ($users as $user) {
        	if ($user['role'] == 'teacher') {
        		$teachers[] = $user['id'];
        	}
        	else{
        		$students[] = $user['id'];
        	}
        }
        foreach ($students as $studentID) {
        	DB::table('studentProf')->insert([
	            'teacher_id' =>$teachers[rand(0, count($teachers) - 1)],
	            'student_id' =>$studentID,
        	]);
        }
    }

}
