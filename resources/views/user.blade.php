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
    <figure>
      <figcaption>{{$answer->questions_created_at}}</figcaption>
      <blockquote>{{$answer->questions_body}}</blockquote>
      <blockquote>{{$answer->body}}</blockquote>
    </figure>
  @endforeach
</section>
<section>
  <h2>Inbox</h2>
  @foreach ($inboxes as $inbox)
    <figure>
      <figcaption>{{$inbox->created_at}}</figcaption>
      <blockquote>{{$inbox->body}}</blockquote>
    </figure>
  @endforeach
</section>
<section>
  <h2>Outbox</h2>
  @foreach ($outboxes as $outbox)
    <figure>
      <figcaption>{{$outbox->created_at}}</figcaption>
      <blockquote>{{$outbox->body}}</blockquote>
    </figure>
  @endforeach
</section>
@endsection
