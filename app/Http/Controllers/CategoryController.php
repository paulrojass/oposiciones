<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
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
        $categoria = new Category();
        $categoria->name = $request->name;
        $categoria->save();
        return redirect('categorias');
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
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category->name = $request->name;
        $category->save();
        return $category; 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        return $category->delete();
    }

    public function view()
    {
        $categories = Category::orderBy('created_at', 'desc')->paginate(6);
        return view('categories', compact('categories'));
    }

    public function delete($id)
    {
        $category = Category::find($id);
        $this->destroy($category);
        return redirect('categorias');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'unique:categories']
        ]);
    }


    public function updateCategory(Request $request)
    {
        //$this->validator($request->all())->validate();
        
        $category = Category::find($request->id);

        $this->update($request, $category);

        return $this->view();
    }
}
