<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use App\User;
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
        return view('home', [
            'inbox' => $inbox,
            'outbox' => $outbox,
            'avater' => \Storage::disk('public')->url($request->user()->avater),
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

    public function avater(Request $request) {
        $validator = Validator::make($request->all(), ['avater' => 'required']);
        if ($validator->fails()) {
            return redirect('/')->withInput()->withErrors($validator);
        }

        $file = $request->file('avater');
        if (!empty($file)) {
            $path = $file->storeAs('avater', $request->user()->id, 'public');
        }

        $user = $request->user();
        $user->avater = $path;
        $user->save();

        return redirect('/home');
    }
}
