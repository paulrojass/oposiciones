<?php

namespace App\Http\Controllers;

use App\Category;
use App\Subcategory;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class SubcategoryController extends Controller
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
        $subcategoria = new Subcategory();
        $subcategoria->name = $request->name;
        $subcategoria->category_id = $request->category_id;
        $subcategoria->save();
        return redirect('categoria/'.$request->category_id.'/subcategorias');
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
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Subcategory $subcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Subcategory $subcategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        $subcategory->name = $request->name;
        $subcategory->save();
        return $subcategory; 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcategory $subcategory)
    {
        return $subcategory->delete();
    }

    public function view($id)
    {
        $category = Category::find($id);

        $subcategories = Subcategory::where('category_id', $id)->orderBy('created_at', 'desc')->paginate(6);
        return view('subcategories', compact('category','subcategories'));
    }

    public function delete($id)
    {
        $subcategory = Subcategory::find($id);
        $this->destroy($subcategory);
        return redirect('categoria/'.$subcategory->category_id.'/subcategorias');

    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'unique:subcategories']
        ]);
    }


    public function updateSubcategory(Request $request)
    {
        //$this->validator($request->all())->validate();
        
        $subcategory = Subcategory::find($request->id);

        $this->update($request, $subcategory);

        return $this->view($subcategory->category->id);
    }


}
