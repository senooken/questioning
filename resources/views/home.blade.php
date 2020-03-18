@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>

<section>
  <h2>Inbox</h2>
  @foreach ($inboxes as $inbox)
  <figure>
    <figcaption>Question ID={{$inbox->id}}, {{$inbox->created_at}}</figcaption>
    <blockquote>{{$inbox->body}}</blockquote>
    <form method="POST" action="{{url('home/answer/'.$inbox->id)}}">
      @csrf
      <textarea name="body">{{$inbox->answers_body}}</textarea>
      <p><button class="btn btn-primary" type="submit">Answer</button></p>
    </form>
  </figure>
  @endforeach
</section>
<section>
  <h2>Outbox</h2>
  @foreach ($outboxes as $outbox)
  <figure>
    <figcaption>Question ID={{$outbox->id}}, {{$outbox->created_at}}</figcaption>
    <blockquote>{{$outbox->body}}</blockquote>
  </figure>
  @endforeach
</section>
@endsection
