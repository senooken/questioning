<?php

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
    $answers = DB::table('questions')
      ->leftJoin('answers', 'questions.id', '=', 'answers.to')
      ->select('questions.id', 'questions.created_at'
          , 'questions.body as question'
          , 'answers.body')
      ->latest('questions.created_at')
      ->limit(20)
      ->get();
    return view('top', [
        'answers' => $answers,
    ]);
});

// /register, /login, /logout
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/home/answer/{question_id}', 'HomeController@answer');

Route::get('/user/{username}', 'UserController@index');

Route::post('/user/{username}/question', 'UserController@question');
