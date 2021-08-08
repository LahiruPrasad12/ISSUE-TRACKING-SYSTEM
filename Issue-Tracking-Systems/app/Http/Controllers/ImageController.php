<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Images;
use App\Models\Issues;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id1, $id2)
    {
        $post1 = Comments::find($id1);
        $post2 = Issues::find($id2);
        $comment = new Images();
        $comment->imagable_type = $request->imagable_type;
        $comment->imagable_id = $request->imagable_id;
        $comment->size = $request->size;
        $comment->path = $request->path;
        $comment->name = $request->name;
        $comment->extension = $request->extension;

        if($post1->images()->$post2->image()->save($comment)){
            return "Image Add Successfully";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Images::findOrfail($id);
        return new CommentResource($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Images::findOrFail($id);
        $post->body = $request->body;

        if($post->save()){
            return new CommentResource($post);
        }
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
