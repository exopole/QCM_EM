<?php

namespace App\Http\Controllers;

use App\Question;
use App\Score;
use App\Choice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('student');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $scores = DB::table('scores')
                ->where('user_id', '=', $user->id)
                ->get();
        $qcmFait = 0;
        $total = count($scores);
        $scoreEleve = 0;
        foreach ($scores as $score) {
            if ($score->status === 'fait') {
                $qcmFait++;
                $scoreEleve += $score->note;
            }
        }

        return view('student.index', compact('user', 'qcmFait', 'scoreEleve', 'total'));
    }

       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexQCM()
    {
        $user = Auth::user();       
        $scores = DB::table('scores')->where('user_id', '=', $user->id)->get();

        $questions = DB::table('questions')
                ->leftjoin('scores', 'questions.id', '=', 'scores.question_id')
                ->where('user_id', '=', $user->id)
                ->select('questions.*')
                ->get(); 

        return view('student.qcmListe', compact('user', 'questions', 'scores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::find($id);
        $choices = $question->choices;
        
        return view('student.qcm', compact('question', 'choices'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $question = Question::find($id);
        $choices = $question->choices;
        $scoreTmp = (DB::table('scores')
                    ->where('user_id', '=', $user->id)
                    ->where('question_id', '=', $question->id)
                    ->get())[0];
        $score = Score::find($scoreTmp->id);
        $result = true;
        $i = 0;
        while($i < count($choices) &&  $result){
            $result = $choices[$i]->status == $request->input($choices[$i]->id);
            $i++;
        }

        $note = ($result)?1:0;
        $message = ($result)?'QCM réussie':'QCM non réussie';

        $score->status = 'fait';
        $score->note = $note;
        $score->save();
        return redirect('student/qcm')->with( ['message' => $message]);

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
