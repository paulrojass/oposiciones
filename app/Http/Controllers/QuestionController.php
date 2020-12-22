<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

use App\Subcategory;
use App\Category;
use App\Tag;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

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
        //$this->validator($request->all())->validate();
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
        $question->content = $request->content;
        $question->save();
        return $question;
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

    public function view(Request $request)
    {
        if ($request) {
            $query=trim($request->get('searchText'));
            $questions=Question::where('content','LIKE','%'.$query.'%')->orderBy('created_at', 'desc')->paginate(100);
            $categories = Category::all();
            return view('questions', compact('questions', 'categories', 'query'));
        }

    }

    public function delete($id)
    {
        $question = Question::find($id);
        $this->destroy($question);
        return redirect('preguntas');
    }

    public function tags($id)
    {
        $question = Question::find($id);

       //$tags = DB::table('question_tags')->select('*')->where('question_id', $question->id)->get();
        $tags = $question->tags;

        $categories = Category::all();



        return view('question-tags', compact('question', 'categories', 'tags'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'content' => ['required', 'unique:questions']
        ]);
    }



    public function updateQuestion(Request $request)
    {

        //$this->validator($request->all())->validate();

        $question = Question::find($request->id);

        $this->update($request, $question);

        return $this->view();
    }

    public function createTag(Request $request)
    {
        $question = Question::find($request->id);

        DB::table('question_tags')->where('question_id', $question->id)->delete();

        if($request->tag){
            foreach ($request->tag as $tag) {
                DB::table('question_tags')->insert(
                    ['tag_id' => $tag, 'question_id' => $question->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
                );
            }
        }
        return redirect('preguntas');
    }
}
