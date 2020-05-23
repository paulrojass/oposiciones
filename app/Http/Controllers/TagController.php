<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

use App\Subcategory;

use Illuminate\Support\Facades\Validator;

class TagController extends Controller
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
        $tag = new Tag();
        $tag->name = $request->name;
        $tag->subcategory_id = $request->subcategory_id;
        $tag->save();
        return redirect('subcategoria/'.$request->subcategory_id.'/etiquetas');

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
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $tag->name = $request->name;
        $tag->save();
        return $tag; 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        return $tag->delete();
    }

    public function view($id)
    {
        $subcategory = Subcategory::find($id);

        $tags = Tag::where('subcategory_id', $id)->orderBy('created_at', 'desc')->paginate(6);
        return view('tags', compact('subcategory','tags'));
    }

    public function delete($id)
    {
        $tag = Tag::find($id);
        $subcategory_id = $tag->subcategory->id;
        $this->destroy($tag);
        return redirect('subcategoria/'.$subcategory_id.'/etiquetas');
    }

    public function updateTag(Request $request)
    {
        //$this->validator($request->all())->validate();
        
        $tag = Tag::find($request->id);

        $this->update($request, $tag);

        return $this->view($tag->subcategory->id);
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'unique:tags']
        ]);
    }


    public function ajaxSearchTagsList(Request $request)
    {
        $tags = Tag::where('subcategory_id', $request->subcategory_id)->get();
        return view('content.client-search-tags-list', compact('tags'));
    }
}
