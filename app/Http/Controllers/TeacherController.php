<?php

namespace App\Http\Controllers;

use App\Question;
use App\User;
use App\Comment;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TeacherController extends Controller
{

     /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function __invoke()
    {
       $user = Auth::user();
        $posts = $user->posts;
        //$posts = $user->posts()->orderBy('date', 'DESC')->get();
        //$posts = Post::orderBy('date', 'DESC')->get();
        $fiches = Question::all();
        // Permet d'avoir tout les etudiants attitré à un professeur
        // $students =  DB::table('users')
        //     ->leftJoin('studentProf', 'id', '=', 'student_id')
        //     ->where('teacher_id', '=', $user->id)
        //     ->get(); 

        $students =  DB::table('users')
             ->where('role', '=', 'final_class')
             ->orwhere('role', '=', 'first_class')
             ->get(); 

        $nbrComments = count(Comment::all());


        return view('teacher.index', compact('user', 'posts', 'fiches', 'students', 'nbrComments'));
    }
}
