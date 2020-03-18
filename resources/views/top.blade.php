@extends('layouts.app')

@section('content')
<h1>Qing</h1>
<p>This is Question & Answer service.</p>
<ol>
    <li><a href="{{url('home')}}">home</a></li>
    <li><a href="{{url('user')}}">user</a></li>
</ol>

<section>
    <h2>Recently Answers</h2>
    <div class="row row-cols-2">
        @foreach ($answers as $answer)
        <div class="col">
            <article class="card">
                <figure class="card-header">
                    <blockquote>
                        <p>{{$answer->question}}</p>
                    </blockquote>
                    <footer><small>Question ID={{$answer->id}}, {{$answer->created_at}}</small></footer>
                </figure>
                <article>
                    <figure>
                        <p>{{$answer->body}}</p>
                        <footer><small>Answer ID=, {{$answer->created_at}}</small></footer>
                    </figure>
                </article>
            </article>
        </div>
        @endforeach
    </div>
</section>
@endsection
