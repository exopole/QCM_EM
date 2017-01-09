<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Choice;
use Illuminate\Support\Facades\DB;

class ChoiceController extends Controller
{
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
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
    public function edit($questionID)
    {
        $choices = DB::table('choices')
             ->where('question_id', '=', $questionID)
             ->get(); 
        $nbrChoice = count($choices);

        return view('teacher.fiches.choices.edit', compact('choices', 'questionID', 'nbrChoice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $questionID)
    {
        $choicesID = DB::table('choices')
            ->select('id')
            ->where('question_id', '=', $questionID)
            ->get();
        foreach ($choicesID as $choiceID) {
            $choice = Choice::find($choiceID->id);
            $choice->content = $request->input($choiceID->id."_content");
            $choice->status = $request->input($choiceID->id."_status");
            $choice->save();
        }

        return redirect('teacher/fiches')->with( ['message' => "Operation correctement effectué"]);

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
