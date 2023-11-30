<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\FeedbackController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("question", [QuestionsController::class, 'addNew'])->name("add_questions_api");
Route::put("question/{id}", [QuestionsController::class, 'update']);
Route::get("question/{id}", [QuestionsController::class, 'show']);
Route::delete("question/{id}", [QuestionsController::class, 'destroy']);
Route::get("questions", [QuestionsController::class, 'listGameQuestion'])->name("list_questions_api");
Route::get("all_questions", [QuestionsController::class, 'listAll'])->name("list_all_questions_api");
Route::get("question-categories", [QuestionsController::class, 'listCategories'])->name("list_categories_api");

Route::apiResource("help", HelpController::class);
Route::apiResource("feedback", FeedbackController::class);