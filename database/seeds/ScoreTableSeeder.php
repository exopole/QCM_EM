<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\User;
use App\Question;

class ScoreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$statusArray = ['fait', 'pas fait'];
    	$noteArray = [0,1];

        $terminales = DB::table('users')
             ->where('role', '=', 'final_class')
             ->get(); 
        $premieres = DB::table('users')
             ->where('role', '=', 'first_class')
             ->get(); 

        $questionTerminale = DB::table('questions')
             ->where('class_level', '=', 'terminale')
             ->get(); 
        $questionPremiere = DB::table('questions')
             ->where('class_level', '=', 'premiere')
             ->get(); 

        foreach ($questionTerminale as $question) {
        	if ($question->status === 'published') {
        		foreach ($terminales as $student) {
        			$status = $statusArray[array_rand($statusArray)];
        			$note = ($status === 'fait') ? $noteArray[array_rand($noteArray)] : 0;
		        	DB::table('scores')->insert([
				        'user_id' => $student->id,
				        'question_id' => $question->id,
				        'status' => $status,
				        'note' => $note
		        	]);
        		}
        	}
        }

        foreach ($questionPremiere as $question) {
        	if ($question->status === 'published') {
        		foreach ($premieres as $student) {
        			$status = $statusArray[array_rand($statusArray)];
        			$note = ($status === 'fait') ? $noteArray[array_rand($noteArray)] : 0;
		        	DB::table('scores')->insert([
				        'user_id' => $student->id,
				        'question_id' => $question->id,
				        'status' => $status,
				        'note' => $note
		        	]);
        		}
        	}
        }






    }
}
