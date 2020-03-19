@extends('layouts.app')

@section('content')
<h1>{{$username}}</h1>
<section>
    <h2>Question form</h2>
    <form method="POST" action="{{url('user/'.$username.'/question')}}">
        @csrf
        <textarea name="body" style="width: 100%;"></textarea>
        <p><button class="btn btn-primary" type="submit">Question</button></p>
    </form>
</section>

<div class="row">
    <section class="col">
        <h2>Answer</h2>
        @foreach ($answers as $answer)
            @component('components.question', ['card' => $answer])
                @component('components.answer', ['card' => $answer])
                @endcomponent
            @endcomponent
        @endforeach
    </section>
    <section class="col">
        <h2>Inbox</h2>
        @foreach ($inboxes as $inbox)
            @component('components.question', ['card' => $inbox])
            @endcomponent
        @endforeach
    </section>
    <section>
        <h2>Outbox</h2>
        @foreach ($outboxes as $outbox)
            @component('components.question', ['card' => $outbox])
            @endcomponent
        @endforeach
    </section>
</div>
@endsection
