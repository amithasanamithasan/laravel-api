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
// get api for fetch user
Route::get('/users/{id?}',[UserApiController::class,'showUser']);
// post api for add users
Route::post('/add-user',[UserApiController::class,'addUser']);
// post api  for add mutipule userss
Route::post('/add-multiple-user',[UserApiController::class,'addMultipleUser']);
// api for update users details
Route::put('/update-user-details/{id}',[UserApiController::class,'updateUserDetails']);
// patch api for update single record
Route::patch('/update-single-record/{id}',[UserApiController::class,'updateSingleRecord']);

// Deleted api for delete single users data table
Route::delete('/delete-single-record/{id}',[UserApiController::class,'DeleteSingleRecord']);
// Detete api for delete single user with json
// json formet e delete korte gale id use kora lagbe na
Route::delete('/delete-single-user-with-json',[UserApiController::class,'deleteUserJson']);
// multiple users deleted for api jahuto mutiple users delete korbo tr jonno {ids} dwa lagbe
Route::delete('/multiple-user-delete/{ids}',[UserApiController::class,'deleteMultiple']);
// jason formet for multiple users deleted
Route::delete('/delete-multiple-user-with-json',[UserApiController::class,'deleteMultipleUserJson']);
// jwt use kore delete  authorization for rest api
Route::delete('/delete-multiple-user-authorization-json',[UserApiController::class,'deleteAuthorizationMultipleUserJson']);