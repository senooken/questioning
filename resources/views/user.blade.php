@extends('layouts.app')

@section('content')
<h1>{{$username}}</h1>
<section>
    <h2>Question form</h2>
    <form method="POST" action="{{url('user/'.$username.'/question')}}">
        @csrf
        <textarea name="body"></textarea>
        <p><button class="btn btn-primary" type="submit">Question</button></p>
    </form>
</section>
<section>
    <h2>Answer</h2>
    @foreach ($answers as $answer)
    <article class="card">
        <figure class="card-header">
            <blockquote><p>{{$answer->questions_body}}</p></blockquote>
            <footer><small>{{$answer->questions_created_at}}</small></footer>
        </figure>
        <article>
            <figure>
                <blockquote><p>{{$answer->body}}</p></blockquote>
                <footer><small>created_at</small></footer>
            </figure>
        </article>
    </article>
    @endforeach
</section>
<section>
    <h2>Inbox</h2>
    @foreach ($inboxes as $inbox)
    <article class="card">
        <figure class="card-header">
            <blockquote><p>{{$inbox->body}}</p></blockquote>
            <footer><small>{{$inbox->created_at}}</small></footer>
        </figure>
    </article>
    @endforeach
</section>
<section>
    <h2>Outbox</h2>
    @foreach ($outboxes as $outbox)
    <article class="card">
        <figure class="card-header">
            <blockquote><p>{{$outbox->body}}</p></blockquote>
            <figcaption><small>{{$outbox->created_at}}</small></figcaption>
        </figure>
    </article>
    @endforeach
</section>
@endsection
