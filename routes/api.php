<?php

use App\Http\Controllers\API\TaskSchedullerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/submit_task', [TaskSchedullerController::class, "storeSchedule"]);
Route::get('/list_tasks', [TaskSchedullerController::class, "listSchedule"]);
Route::put('/task_update/{id?}', [TaskSchedullerController::class, "updateSchedule"]);
Route::delete('/task_destroy/{id?}', [TaskSchedullerController::class, "deleteSchedule"]);
Route::delete('/remove_all', [TaskSchedullerController::class, "deleteAllTask"]);
