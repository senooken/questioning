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
    $answers = DB::table('answers')
      ->leftJoin('questions', 'questions.id', '=', 'answers.to')
      ->select('questions.id as q_id'
          , 'questions.created_at as q_created_at'
          , 'questions.name as q_username'
          , 'questions.body as q_body'
          , 'answers.updated_at as a_updated_at'
          , 'answers.name as a_username'
          , 'answers.body as a_body'
      )
      ->latest('questions.created_at')
      ->limit(20)
      ->get();
    return view('top', ['answers' => $answers]);
});


Route::get('/question/{question_id}', function ($question_id) {
    $card = DB::table('questions')
      ->where('questions.id', $question_id)
      ->leftJoin('answers', 'questions.id', '=', 'answers.to')
      ->select('questions.id as q_id'
          , 'questions.created_at as q_created_at'
          , 'questions.name as q_username'
          , 'questions.body as q_body'
          , 'answers.updated_at as a_updated_at'
          , 'answers.name as a_username'
          , 'answers.body as a_body'
      )
      ->first();
    return view('question', ['card' => $card]);
});


// /register, /login, /logout
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::put('/home/avatar', 'HomeController@avatar');

Route::put('/home/profile', 'HomeController@profile');

Route::put('/home/answer/{question_id}', 'HomeController@answer');

Route::get('/user', 'UserController@index');

Route::get('/user/{name}', 'UserController@name');

Route::post('/user/{name}/question', 'UserController@question');
