<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Score;

class Question extends Model
{
	protected $fillable=[
		'title',
		'status',
		'content',
		'class_level'
	];


	public function choices(){
		return $this->hasMany('App\Choice');
	}


	public function scores(){
		return $this->belongsToMany('App\Score');
	}

	public function class_levelUser(){
		return ($this->class_level === 'premiere') ? 'first_class' : 'final_class';
	}

	public function setToUnpublished(){
        $scores = DB::table('scores')
             ->where('question_id', '=', $this->id)
             ->get(); 
         if (count($scores) > 0) {
         	# code...
	        foreach ($scores as $score) {
	        	Score::destroy($score->id);
	        }
         }
		$this->attributes['status'] = "unpublished";
		$this->save();
	}

	public function setToPublished(){
		if ($this->attributes['status'] != "published") {
			# code...
			$students = DB::table('users')
	             ->where('role', '=', $this->class_levelUser())
	             ->get(); 
	        foreach ($students as $student) {
		    	DB::table('scores')->insert([
			        'user_id' => $student->id,
			        'question_id' => $this->id,
		    	]);
	        	
	        }
			$this->attributes['status'] = "published";
	        	$this->save();
		}
	}

}
