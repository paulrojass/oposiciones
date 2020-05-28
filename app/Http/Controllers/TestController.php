<?php

namespace App\Http\Controllers;

use App\Test;
use Illuminate\Http\Request;

use App\Category;
use App\Subcategory;
use App\Tag;
use App\Question;

use Auth;
use DB;

class TestController extends Controller
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
    public function create($questions)
    {
        $test = $this->createTest($questions);

        $questions_id = separateQuestions($questions);

        return view('examen', compact('test', 'questions_id'));
    }

    public function createTest()
    {

        $subcategories = Subcategory::all();
        return view('client.crear-examen', compact('subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $questions_string = $this->questionString($request->tag, $request->number);
        $tags_string = $this->tagString($request->tag);
        $test = new Test;
        $test->questions = $questions_string;
        $test->tags = $tags_string;
        $test->user_id = auth()->user()->id;
        $test->save();
        return $test;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function show(Test $test)
    {
        $questions_array = explode(",", $test->questions);

        $questions = Question::find($questions_array);

        return view('client.test', compact('test', 'questions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function edit(Test $test)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Test $test)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy(Test $test)
    {
        //
    }

    public function searchQuestions(Request $request)
    {

        $tags = isset($request->tag) ? json_decode($request->tag) : array();

        $questions = $this->questionsList($tags);

        return view('content.client-search-results', compact('questions'));
    }

    public function questionsList($tags)
    {
        $questions = (new Question)->newCollection();
        foreach ($tags as $tag => $value) {
            $tag = Tag::find($value);
            $parte = $tag->questions;
            $questions = $questions->merge($parte);
        }
        return $questions; 
    }

    public function newTest(Request $request)
    {
        $test = $this->store($request);

        return $this->show($test);
    }

    public function questionString($tags, $number)
    {
        $questions = $this->questionsList($tags);

        $questions = $questions->random($number);

        $questions_array = $questions->modelKeys();

        $questions_string = implode(",", $questions_array);

        return $questions_string;

    }

    public function tagString($tags)
    {
        $tags_string = implode(",", $tags);

        return $tags_string;
    }

    public function testView($test_id)
    {
        $test = Test::find($test_id);

        if($test->user_id != auth()->user()->id) return back();

        return $this->show($test);

    }
}
