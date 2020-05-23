<?php

namespace App\Http\Controllers;

use App\Test;
use Illuminate\Http\Request;

use App\Category;
use App\Subcategory;
use App\Tag;
use App\Question;

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

    public function newTest()
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
        $test = new Test;
        $test->questions = $request->questions;
        $test->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function show(Test $test)
    {
        //
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
/*        $tags = $request->tags;
        foreach ($tags as $tag) {
            $questions = DB::table('question_tags')->where('tag_id', $tag)->get();
        }
*/

        dd($request);
        $questions = Question::all();
        return view('client.resultados-busqueda', compact('questions'));
    }


    public function createTest($questions)
    {
        $test = new Test;
        $test->questions = $questions;
        $test = save();
        return $test;
    }

}
