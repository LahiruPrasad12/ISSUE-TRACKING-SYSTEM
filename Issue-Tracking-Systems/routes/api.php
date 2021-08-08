<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



use \App\Http\Controllers\ImageController;
use \App\Http\Controllers\CommentController;
use \App\Http\Controllers\IssueController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});





/*-----------------------------------------Add Data-----------------------------------------*/

//this route used to add data to the Issues table
Route::post('/issue',[IssueController::class,'store']);

//this route used to add data to the Comment table
Route::post('/comment/{id}',[CommentController::class,'store']);

//this route used to add data to the Image table
Route::post('/image/{id1}/{id2}',[ImageController::class,'store']);



/*-----------------------------------------Get One Data-----------------------------------------*/

//This route used to get specific data from Issues table
Route::get('/issue/{id}',[IssueController::class,'show']);

////This route used to get specific data from Comment table
Route::get('/comment/{id}',[CommentController::class,'show']);




/*-----------------------------------------Get All Data-----------------------------------------*/
//This route used to get all data from Issues table
Route::get('/issue',[IssueController::class,'index']);

//This route used to get all data from Comment table
Route::get('/comment',[CommentController::class,'index']);

//This route used to get all data from Comment table
Route::get('/image',[ImageController::class,'index']);


/*-----------------------------------------Update Data-----------------------------------------*/
//This controller is used to update issue table data
Route::put('/issue/{id}',[IssueController::class,'update']);

//This controller is used to update comment table data
Route::put('/comment/{id}',[CommentController::class,'update']);


/*-----------------------------------------Delete Data-----------------------------------------*/
//This route used to delete issue table data
Route::delete('/issue/{id}',[IssueController::class,'destroy']);

//This route used to delete comment table data
Route::delete('/comment/{id}',[CommentController::class,'destroy']);




/*-----------------------------------------get sub table Data using parent id's-----------------------------------------*/
//This route used to get all comment which under one specific Issue
Route::get('comments/issue/{id}',[CommentController::class,'getCommentUsingPostId']);
