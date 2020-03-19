<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Question;
use App\Answer;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $username = $request->user()->name;
        $inboxes = DB::table('questions')
          ->leftJoin('answers', 'questions.id', '=', 'answers.to')
          ->select('questions.id as q_id'
              , 'questions.created_at as q_created_at'
              , 'questions.body as q_body'
              , 'answers.body as a_body')
          ->where('questions.to', $username)
          ->latest('questions.created_at')
          ->get();
        $outboxes = Question::where('username', $username)->latest()
            ->select('id as q_id', 'created_at as q_created_at', 'body as q_body')
            ->get();
        return view('home', [
            'inboxes' => $inboxes,
            'outboxes' => $outboxes,
        ]);
    }

    public function answer(Request $request, $question_id) {
        $validator = Validator::make($request->all(), ['body' => 'required']);
        if ($validator->fails()) {
            return redirect('/')->withInput()->withErrors($validator);
        }

        $answer = new Answer;
        $answer->username = $request->user()->name ?? '';
        $answer->to = $question_id;
        $answer->body = $request->body;
        $answer->save();
        return redirect('/home');
    }
}
