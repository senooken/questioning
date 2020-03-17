<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $inboxes = Question::where('to', $username)->orderBy('created_at', 'desc')->get();
        $outboxes = Question::where('username', $username)->orderBy('created_at', 'desc')->get();
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
