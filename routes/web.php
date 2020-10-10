<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::group(['middleware' => 'auth'],function() {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('exercise', '\App\Http\Controllers\ExerciseController@getListExercise')->name('exercise');
    Route::get('quiz', '\App\Http\Controllers\QuizController@getListQuiz')->name('quiz');
    Route::get('user', '\App\Http\Controllers\UserController@getListUser')->name('user');
    Route::get('profile', '\App\Http\Controllers\UserController@getProfile')->name('profile');
    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');
    Route::get('messages', '\App\Http\Controllers\MessagesController@getListMessages')->name('messages');
    Route::group(['prefix' => 'user'], function () {
        Route::get('detail/{username}', '\App\Http\Controllers\UserController@getDetailUser');
        Route::get('get_add_user', '\App\Http\Controllers\UserController@getAddUser')->name('user/get_add_user');
        Route::post('add_user', '\App\Http\Controllers\UserController@addUser')->name('user/add_user');
        Route::get('/edit/{username}', '\App\Http\Controllers\UserController@editUser');

    });
    Route::group(['prefix' => 'exercise'], function () {
        Route::post('add_exercise',
            '\App\Http\Controllers\ExerciseController@addExercise')->name('exercise/add_exercise');
    });
    Route::group(['prefix' => 'quiz'], function () {
        Route::post('add_quiz', '\App\Http\Controllers\QuizController@addQuiz')->name('quiz/add_quiz');
    });
    Route::group(['prefix' => 'message'], function () {
        Route::get('messages/{username}', '\App\Http\Controllers\MessagesController@getListMessages');
    });
});
