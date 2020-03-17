<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Question;

class UserController extends Controller
{
  public function index($username) {
    $inboxes = Question::where('to', $username)->orderBy('created_at', 'desc')->get();
    $outboxes = Question::where('username', $username)->orderBy('created_at', 'desc')->get();
    return view('user', [
      'username' => $username,
      'inboxes' => $inboxes,
      'outboxes' => $outboxes,
    ]);
  }

  public function question(Request $request, $username) {
    $validator = Validator::make($request->all(), ['body' => 'required']);
    if ($validator->fails()) {
      return redirect('/')->withInput()->withErrors($validator);
    }

    $question = new Question;
    $question->username = $request->user()->name ?? '';
    $question->to = $username;
    $question->body = $request->body;
    $question->save();
    return redirect('/user/'.$username);
  }
}