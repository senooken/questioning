<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Question;

class UserController extends Controller
{
    public function index($username) {
        $inbox = DB::table('questions')->where('questions.to', $username)
            ->latest('q_created_at')->latest('a_updated_at')
            ->leftJoin('answers', 'answers.to', '=', 'questions.id')
            ->select('questions.id as q_id'
                , 'questions.created_at as q_created_at'
                , 'questions.body as q_body'
                , 'answers.id as a_id'
                , 'answers.updated_at as a_updated_at'
                , 'answers.body as a_body')
            ->get();
        $outbox = DB::table('questions')->where('questions.username', $username)
            ->latest('q_created_at')->latest('a_updated_at')
            ->leftJoin('answers', 'questions.id', '=', 'answers.to')
            ->select('questions.id as q_id'
                , 'questions.created_at as q_created_at'
                , 'questions.body as q_body'
                , 'answers.id as a_id'
                , 'answers.updated_at as a_updated_at'
                , 'answers.body as a_body')
            ->get();
        return view('user', [
            'username' => $username,
            'inbox' => $inbox,
            'outbox' => $outbox,
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
