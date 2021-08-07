<?php

namespace App\Http\Controllers;

use App\Http\Resources\IssueResource;
use App\Models\Issues;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Issues::paginate(10);
        return IssueResource::collection($post);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Issues();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->uuid = $request->uuid;
        $post->slug = $request->slug;


        if($post->save()){
            return new IssueResource($post);
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
        $post = Issues::findOrfail($id);
        return new IssueResource($post);
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
        $post = Issues::findOrFail($id);
        $post->title = $request->title;
        $post->body = $request->body;
        $post->uuid = $request->uuid;
        $post->slug = $request->slug;;

        if($post->save()){
            return new IssueResource($post);
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
        $post = Issues::findOrFail($id);
        if($post->delete()){
            return new IssueResource($post);
        }
    }
}
