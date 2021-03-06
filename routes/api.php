<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VacancyController;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


Route::middleware('jwt.auth')->group(function () {
    Route::apiResource('/vacancy', VacancyController::class);
    Route::post('/apply_vacancy/{id}', [VacancyController::class, "applyVacancies"]);
    Route::get('/user/my_vacancies', [UserController::class, "myVacancies"]);
    Route::get('/user/my_applications', [UserController::class, "myApplications"]);
    Route::get('/category/{id}', [CategoryController::class, "getVacanciesByCategory"]);
});
