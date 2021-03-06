<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $name = $request->user()->name;
        $inbox = DB::table('questions')->where('questions.to', $name)
            ->latest('q_created_at')->latest('a_updated_at')
            ->leftJoin('answers', 'answers.to', '=', 'questions.id')
            ->select('questions.id as q_id'
                , 'questions.name as q_name'
                , 'questions.created_at as q_created_at'
                , 'questions.body as q_body'
                , 'answers.id as a_id'
                , 'answers.name as a_name'
                , 'answers.updated_at as a_updated_at'
                , 'answers.body as a_body')
            ->get();
        $outbox = DB::table('questions')->where('questions.name', $name)
            ->latest('q_created_at')->latest('a_updated_at')
            ->leftJoin('answers', 'questions.id', '=', 'answers.to')
            ->select('questions.id as q_id'
                , 'questions.name as q_name'
                , 'questions.created_at as q_created_at'
                , 'questions.body as q_body'
                , 'answers.id as a_id'
                , 'answers.name as a_name'
                , 'answers.updated_at as a_updated_at'
                , 'answers.body as a_body')
            ->get();
        return view('home', [
            'user' => $request->user(),
            'inbox' => $inbox,
            'outbox' => $outbox,
            'avatar' => \Storage::disk('public')->url($request->user()->avatar),
        ]);
    }

    public function answer(Request $request, $question_id) {
        $request->validate(['body' => 'required']);

        $answer = new Answer;
        $answer->name = $request->user()->name ?? '';
        $answer->to = $question_id;
        $answer->body = $request->body;
        $answer->save();
        return redirect('/home');
    }

    public function avatar(Request $request) {
        $file = $request->file('avatar');
        if (!empty($file)) {
            $path = $file->storeAs('avatar'
                , $request->user()->id . "." . $file->extension(), 'public');
        }

        $user = $request->user();
        $user->avatar = $path ?? '';
        $user->save();

        return redirect('/home');
    }

    public function profile(Request $request) {
        $user = $request->user();
        $user->profile = $request->profile;
        $user->save();
        return redirect('/home');
    }
}
