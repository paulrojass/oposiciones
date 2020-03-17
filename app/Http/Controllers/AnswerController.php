<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;

use App\Question;

use Illuminate\Support\Facades\Validator;

class AnswerController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {
        $answer = new Answer();
        $answer->content = $request->content;
        $answer->question_id = $request->question_id;
        if($request->correct) $answer->correct = 1;
        else $answer->correct = 0;
        $answer->save();
        return redirect('pregunta/'.$request->question_id.'/respuestas');

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
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Answer $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Answer $answer)
    {
        $answer->content = $request->content;
        $answer->save();
        return $answer; 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */

    public function destroy(Answer $answer)
    {
        return $answer->delete();
    }

    public function view($id)
    {
        $question = Question::find($id);

        $answers = Answer::where('question_id', $id)->orderBy('created_at', 'desc')->paginate(10);
        return view('answers', compact('question','answers'));
    }

    public function updateAnswer(Request $request)
    {    
        $answer = Answer::find($request->id);

        $this->update($request, $answer);

        return $this->view($answer->question->id);
    }

    public function delete($id)
    {
        $answer = Answer::find($id); 
        $this->destroy($answer);
        return redirect('pregunta/'.$answer->question_id.'/respuestas');
    }
}
