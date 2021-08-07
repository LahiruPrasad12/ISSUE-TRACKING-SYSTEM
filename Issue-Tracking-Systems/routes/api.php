<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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




/*-----------------------------------------Get One Data-----------------------------------------*/

//this route used to get specific data from Issues table
Route::get('/issue/{id}',[IssueController::class,'show']);




/*-----------------------------------------Get All Data-----------------------------------------*/
//This route used to get all data from Issues table
Route::get('/issue',[IssueController::class,'index']);

//This route used to get all data from Comment table
Route::get('/comment',[CommentController::class,'index']);


/*-----------------------------------------Update Data-----------------------------------------*/
Route::put('/issue/{id}',[IssueController::class,'update']);




/*-----------------------------------------Delete Data-----------------------------------------*/
Route::delete('/issue/{id}',[IssueController::class,'destroy']);




/*-----------------------------------------get sub table Data using parent id's-----------------------------------------*/
