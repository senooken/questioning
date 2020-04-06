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
            @component('components.question', ['card' => $answer])
                @component('components.answer', ['card' => $answer])
                @endcomponent
            @endcomponent
        </div>
        @endforeach
    </div>
</section>
@endsection
