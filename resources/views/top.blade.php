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
  @foreach ($answers as $answer)
  <figure>
  <figcaption>Question ID={{$answer->id}}, {{$answer->created_at}}</figcaption>
  <blockquote>{{$answer->question}}</blockquote>
  <blockquote>{{$answer->body}}</blockquote>
  </figure>
  @endforeach
</section>
@endsection
