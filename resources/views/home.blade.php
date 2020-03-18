@extends('layouts.app')

@section('content')
<div>
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

<div class="row">
    <section class="col">
        <h2>Inbox</h2>
        @foreach ($inboxes as $inbox)
        <article class="card">
            <figure class="card-header">
                <blockquote>
                    <p>{{$inbox->body}}</p>
                </blockquote>
                <footer><small>Question ID={{$inbox->id}}, {{$inbox->created_at}}</small></footer>
            </figure>
            <article>
                <form method="POST" action="{{url('home/answer/'.$inbox->id)}}">
                    @csrf
                    <textarea name="body">{{$inbox->answers_body}}</textarea>
                    <p><button class="btn btn-primary" type="submit">Answer</button></p>
                </form>
            </article>
        </article>
        @endforeach
    </section>
    <section class="col">
        <h2>Outbox</h2>
        @foreach ($outboxes as $outbox)
        <article class="card">
            <figure class="card-header">
                <blockquote>
                    <p>{{$outbox->body}}</p>
                </blockquote>
                <footer><small>Question ID={{$outbox->id}}, {{$outbox->created_at}}</small></footer>
            </figure>
        </article>
        @endforeach
    </section>
</div>
@endsection
