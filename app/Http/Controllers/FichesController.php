<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Choice;
use App\Score;

class FichesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::paginate(15);

        
        return view('teacher.fiches.index', compact('questions'));
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
        $result = $request->all();
        $message = "";
        if (array_key_exists('idArray', $result) && array_key_exists('action', $result) ) {
            
            $idArray = $result['idArray'];
            $action = $result['action'];
            $message .= $action." ";

            foreach ($idArray as $id) {
                $question = Question::find($id);

                $message .= $question->title.'  ';
                if ($action == 'published') {
                    $question->setToPublished();
                }
                else if ($action == 'unpublished') {
                    $question->setToUnpublished();
                }

            }
        }

        return redirect('teacher/fiches')->with( ['message' => $message]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $scores = DB::table('scores')
                    -> where('question_id', '=', $id)
                    ->get();
        foreach ($score as $score) {
            Score::destroy($score->id);
        }

        $choices = DB::table('choice')
                    ->where('question_id', '=', $id)
                    ->get();
        foreach ($choices as $choice) {
            Choice::destroy($choice->id);
        }
        die($id);
        Question::destroy($id);
    }
}
