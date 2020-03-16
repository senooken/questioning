<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Question;

class UserController extends Controller
{
  public function index($username) {
    return view('user', ['username' => $username]);
  }

  public function question(Request $request, $username) {
    $validator = Validator::make($request->all(), ['body' => 'required']);
    if ($validator->fails()) {
      return redirect('/')->withInput()->withErrors($validator);
    }

    $question = new Question;
    $question->username = $request->user() ? $request->user()->name() : '';
    $question->to = $username;
    $question->body = $request->body;
    $question->save();
    return redirect('/');
  }
}
