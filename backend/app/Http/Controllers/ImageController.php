<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Http\Resources\ImageResource;
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
        $post = Images::paginate(10);
        return ImageResource::collection($post);
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
    public function store(ImageRequest $request)
    {

        $post = Issues::first();

        $comment = new Images();
        $comment->size = $request->size;
        $comment->path = $request->path;
        $comment->name = $request->name;
        $comment->extension = $request->extension;

        if($post->images()->save($comment)){
            return new ImageResource($comment);
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
        return new ImageResource($post);
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
    public function update(ImageRequest $request,$id1)
    {
        $comment = Images::findOrFail($id1);
        $comment->size = $request->size;
        $comment->path = $request->path;
        $comment->name = $request->name;
        $comment->extension = $request->extension;

        if($comment->save()){
            return new ImageResource($comment);
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
        $post = Images::findOrFail($id);
        if($post->delete()){
            return new ImageResource($post);
        }
    }


    //This function return all images of one specific Issue
    public function getImageUsingIssueId($id){
        $image = Issues::find($id)->images;
        return $image;
    }


    //This function return all images of one specific comment
    public function getImageUsingCommentId($id){
        $image = Comments::find($id)->images;
        return $image;
    }
}
