<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;


//Open Route
//URL: http://127.0.0.1:8000/api/register
Route::post("register", [ApiController::class,"register"]);

Route::post("login", [ApiController::class,"login"]);



// Protect Route
Route::group([
    "middleware" => ["auth:sanctum"]
], function(){
    // If token is valid, we will hit all these methods
    // If we pass a invalid value in token , "auth:sanctum" will take cake automatically
    Route::get("profile",[ApiController::class,"profile"]);
    Route::get("logout",[ApiController::class,"logout"]);
    Route::get("refresh-token",[ApiController::class,"refreshToken"]);

    //Get all Tokens 
    Route::get("delete-token/{tokenID}",[ApiController::class,"deleteSingleToken"]);


});






// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
