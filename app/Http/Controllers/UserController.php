<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Question;

class UserController extends Controller
{
    public function index($username) {
        $inboxes = Question::where('to', $username)->latest()
            ->select('id as q_id', 'created_at as q_created_at', 'body as q_body')->get();
        $outboxes = Question::where('username', $username)->latest()
            ->select('id as q_id', 'created_at as q_created_at', 'body as q_body')->get();
        $answers = DB::table('answers')
            ->leftJoin('questions', 'answers.to', '=', 'questions.id')
            ->select('questions.id as q_id'
                , 'questions.created_at as q_created_at'
                , 'questions.body as q_body'
                , 'answers.body as a_body'
                , 'answers.updated_at as a_updated_at'
            )
            ->where('questions.to', $username)
            ->latest('questions.created_at')
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
