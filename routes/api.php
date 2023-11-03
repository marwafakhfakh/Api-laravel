<?php
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\OptionController;
use App\Http\Controllers\Api\QuizController;
use App\Http\Controllers\Api\QuizHistoryController;
use App\Http\Controllers\Api\NiveauController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Resources\UserResource;



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
    return new UserResource($request->user());
});

Route::post('/login',[LoginController::class,'login']);
Route::post('/register',[RegisterController::class,'register']);
/*
Route::get('/admin',function (){
    return View('admin.index');
})->middleware(['auth','role:admin'])->name('admin.index');



//Route::post('/auth/login',[AuthController::class, 'login']);
//Route::post('/auth/register',[AuthController::class, 'register']);

Route::group(['middleware'=>['auth:sanctum']], function(){
    Route::get('auth/profile' ,[AuthController::class, 'profile']);
    Route::put('auth/edit-profile' ,[AuthController::class, 'edit']);
});

Route::post('admin')->middleware(['auth','isAdmin'])->group(function(){
    Route::get('auth/login' ,[AuthController::class, 'login']);
});
*/
// pour categorie 
/*Route::get('categories', [CategoriesController::class , 'Index']);
Route::post('categories', [CategoriesController::class , 'store']);
Route::get('categories/{id}', [CategoriesController::class , 'show']);
Route::get('categories/{id}/edit', [CategoriesController::class , 'edit']);
Route::put('categories/{id}/edit', [CategoriesController::class , 'update']);
Route::delete('categories/{id}/delete  ', [CategoriesController::class , 'destory']);
*/
Route::post('/create',[CategoriesController::class,'create']);
Route::get('/get',[CategoriesController::class,'get']);
Route::patch('/edit/{id}',[CategoriesController::class,'edit']);
Route::post('/update/{id}',[CategoriesController::class,'update']);
Route::delete('/delete/{id}',[CategoriesController::class,'delete']);


// pour question 
Route::get('questions', [QuestionController::class , 'Index']);
Route::post('questions', [QuestionController::class , 'store']);
Route::get('questions/{id}', [QuestionController::class , 'show']);
Route::get('questions/{id}/edit', [QuestionController::class , 'edit']);
Route::put('questions/{id}/update', [QuestionController::class , 'update']);
Route::delete('questions/{id}/delete', [QuestionController::class , 'destory']);

// pour option



Route::get('options', [OptionController::class , 'Index']);
Route::post('options', [OptionController::class , 'store']);
Route::get('options/{id}/edit', [OptionController::class , 'edit']);
Route::put('options/{id}/update', [OptionController::class , 'update']);
Route::delete('options/{id}/delete', [OptionController::class , 'destory']);


// pour quizzez

//Route::resource('quizzes', QuizController::class);

//pour QuizHistory

Route::resource('quizzeshistorical', QuizHistoryController::class);

Route::resource('quizz', QuizController::class);

Route::resource('niveau', NiveauController::class);
