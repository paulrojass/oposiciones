<?php

namespace App\Http\Controllers;

use App\Test;
use Illuminate\Http\Request;

use App\Category;
use App\Subcategory;
use App\Tag;
use App\Question;
use App\Answer;
use App\User;

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
        $answers_string = $this->answerString($request->number);
        $test = new Test;
        $test->questions = $questions_string;
        $test->answers = $answers_string;
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
        if ($test->finished) return $this->testFinished($test);

        $questions_array = explode(",", $test->questions);

        $questions = Question::find($questions_array);

        $answers = explode(",", $test->answers);

        //$answers = Answer::find($answers_array);
        
        return view('client.test', compact('test', 'questions', 'answers'));
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

    public function answerString($number){
        $answers = array();
        for ($i=0; $i < $number; $i++) { 
            array_push($answers, 0);
        }
        return implode(',', $answers);
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

    public function saveTest(Request $request)
    {
        if(!$request->answer) return back();
        $answers_array = $this->answersComplete($request);

        $answers_string = implode(",", $answers_array);

        $test = Test::find($request->test_id);
        $test->answers = $answers_string;

        if(!in_array(0, $answers_array)) $test->finished = 1;
        else $test->finished = 0;

        $test->save();

        if ($test->finished) return $this->testFinished($test);
        return redirect('mi-perfil');
    }

    public function answersComplete(Request $request)
    {
        $answers = array();
        for ($i = 0; $i < $request->value ; $i++) { 
            if(array_key_exists($i+1, $request->answer))
            {
                array_push($answers, $request->answer[$i+1]);
            }else{
                array_push($answers, 0);
            }
        }
        return $answers;
    }

    public function evaluate(Test $test)
    {
        $questions = explode(',', $test->questions);

        $correct = $this->correctAnswers($questions);

        $answers = explode(',', $test->answers);

        $incorrect = array_diff($answers, $correct);

        $result = 100 - (sizeof($incorrect)*100) / sizeof($answers);

        return $result;
    }

    public function correctAnswers($questions)
    {
        $correct = array();
        foreach ($questions as $question) {
            $answer = Answer::where('question_id', $question)->where('correct', 1)->pluck('id')->first();
            array_push($correct, $answer);
        }
        return $correct;
    }

    public function testFinished(Test $test)
    {
        $questions = Question::find(explode(',', $test->questions));

        $correct = Answer::find($this->correctAnswers(explode(',', $test->questions)));

        $answers = Answer::find(explode(',',$test->answers));

        $result = $this->evaluate($test);

        return view('client.test-finished', compact('test', 'result', 'questions', 'answers', 'correct' ));
    }

    public function adminView($user_id)
    {
        $user = User::find($user_id);

        $tests = array();
        $results = array();
        $tags = array();
        foreach ($user->tests as $test) {
            $result = $this->evaluate($test);
            array_push($tests, $test->id);
            array_push($results, $result);
            $lista_tags = explode(',', $test->tags);
            array_push($tags, $lista_tags[0]);

        }

        return view('user-test', compact('user','tests','results', 'tags'));
    }
}
