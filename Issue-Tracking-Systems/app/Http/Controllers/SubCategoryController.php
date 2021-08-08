<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubCategoryRequest;
use App\Http\Resources\SubCategoryResource;
use App\Models\Category;
use App\Models\Issues;
use App\Models\Subcategories;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Subcategories::paginate(10);
        return SubCategoryResource::collection($post);
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
    public function store(SubCategoryRequest $request, $id1)
    {
        $post = Category::find($id1);
        $issue = Issues::first();
        $sub = Subcategories::first();
        $comment = new Subcategories();
        $comment->name = $request->name;
        $comment->description = $request->description;

        if($post->subCategory()->save($comment)){
//            $roleids = [$issue,$sub];
//            $comment->issues()->attach($roleids);

            $sub->issues()->attach($issue);
            return "Sub Category Add Successfully";
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
        $post = Subcategories::findOrfail($id);
        return new SubCategoryResource($post);
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
    public function update(SubCategoryRequest $request, $id)
    {
        $comment = Subcategories::findOrFail($id);
        $comment->name = $request->name;
        $comment->description = $request->description;

        if($comment->save()){
            return new SubCategoryResource($comment);
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
        $post = Subcategories::findOrFail($id);
        if($post->delete()){
            return new SubCategoryResource($post);
        }
    }


    //This function return all sub categories of one specific categories
    public function getsubCategoryUsingCategoryID($id){
        $comment = Category::find($id)->subCategory;
        return $comment;
    }
}
