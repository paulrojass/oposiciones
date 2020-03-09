<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

use App\Category;
use App\Tag;
use DB;
use Carbon\Carbon;

class QuestionController extends Controller
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
        $question = new Question();
        $question->content = $request->content;
        $question->save();
        if($request->tag){
            foreach ($request->tag as $tag) {
                DB::table('question_tags')->insert(
                    ['tag_id' => $tag, 'question_id' => $question->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
                );
            }
        }
        return redirect('preguntas');
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
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        return $question->delete();
    }

    public function view()
    {
        $questions = Question::orderBy('created_at', 'desc')->paginate(6);
        $categories = Category::all();
        return view('questions', compact('questions', 'categories'));
    }

    public function delete($id)
    {
        $question = Question::find($id);
        $this->destroy($question);
        return redirect('preguntas');
    }

}
