<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Question;

class UserController extends Controller
{
    public function index($username) {
        $inboxes = Question::where('to', $username)->orderBy('created_at', 'desc')->get();
        $outboxes = Question::where('username', $username)->orderBy('created_at', 'desc')->get();
        $answers = DB::table('answers')
            ->leftJoin('questions', 'answers.to', '=', 'questions.id')
            ->select('questions.id as questions_id'
                , 'questions.created_at as questions_created_at'
                , 'questions.body as questions_body'
                , 'answers.body')
            ->where('questions.to', $username)
            ->orderBy('questions.created_at', 'desc')
            ->get();
        return view('user', [
            'username' => $username,
            'inboxes' => $inboxes,
            'outboxes' => $outboxes,
            'answers' => $answers,
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
