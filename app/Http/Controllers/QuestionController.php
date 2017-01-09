<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Choice;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('teacher');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('teacher.fiches.questions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'=> 'required|max:100',
            'nbrChoices' => 'required|integer',
            'class_level' => 'in:premiere,terminale',
            'content' => 'required'
        ]);
        $input = $request->all();
        $question = Question::create($input);
        $questionID = $question->id;

        $nbrChoices = $request->input('nbrChoices');
        for ($i=0; $i < $nbrChoices; $i++) { 
            $choice = Choice::create();
            $choice->question_id = $questionID;
            $choice->save();
        }

        return redirect('teacher/fiches/choices/'.$questionID);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::find($id);
        
        return view('teacher.fiches.questions.edit', compact('question'));    
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
        $this->validate($request, [
            'title'=> 'required|max:100',
            'class_level' => 'in:premiere,terminale',
            'content' => 'required'
        ]);


        $question = Question::find($id);
        $question->update($request->all());

        return redirect('teacher/fiches/choices/'.$question->id);

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
