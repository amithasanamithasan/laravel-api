<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserApiController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

 Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
     return $request->user();
});

// Route::get('massage',function(){
//     // return 'welcome to API';
//     return response()->json([
//         'massage'=>'welcome to laravel API']);

// });

Route::get('/users/{id?}',[UserApiController::class,'showUser']);