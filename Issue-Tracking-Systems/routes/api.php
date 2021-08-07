<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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

//this route used to add issue to the database
Route::post('/issue',[IssueController::class,'store']);




/*-----------------------------------------Get One Data-----------------------------------------*/

//this route used to get specific data from table
Route::get('/issue/{id}',[IssueController::class,'show']);




/*-----------------------------------------Get All Data-----------------------------------------*/





/*-----------------------------------------Delete Data-----------------------------------------*/
