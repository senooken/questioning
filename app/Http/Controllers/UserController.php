<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Question;

class UserController extends Controller
{
    public function index() {
        $users = \App\User::get();
        return view('user', ['users' => $users]);
    }

    public function name($name) {
        $inbox = DB::table('questions')->where('questions.to', $name)
            ->latest('q_created_at')->latest('a_updated_at')
            ->leftJoin('answers', 'answers.to', '=', 'questions.id')
            ->select('questions.id as q_id'
                , 'questions.created_at as q_created_at'
                , 'questions.name as q_name'
                , 'questions.body as q_body'
                , 'answers.id as a_id'
                , 'answers.updated_at as a_updated_at'
                , 'answers.name as a_name'
                , 'answers.body as a_body')
            ->get();
        $outbox = DB::table('questions')->where('questions.name', $name)
            ->latest('q_created_at')->latest('a_updated_at')
            ->leftJoin('answers', 'answers.to', '=', 'questions.id')
            ->select('questions.id as q_id'
                , 'questions.created_at as q_created_at'
                , 'questions.name as q_name'
                , 'questions.body as q_body'
                , 'answers.id as a_id'
                , 'answers.updated_at as a_updated_at'
                , 'answers.name as a_name'
                , 'answers.body as a_body')
            ->get();
        return view('user.name', [
            'user' => DB::table('users')->where('name', $name)->first(),
            'inbox' => $inbox,
            'outbox' => $outbox,
        ]);
    }

    public function question(Request $request, $name) {
        $request->validate(['body' => 'required']);

        $question = new Question;
        $question->name = $request->user()->name ?? '';
        $question->to = $name;
        $question->body = $request->body;
        $question->save();
        return redirect('/user/'.$name);
    }
}
