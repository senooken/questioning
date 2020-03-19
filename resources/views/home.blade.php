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
            @component('components.question', ['card' => $inbox])
            <article>
                <form method="POST" action="{{url('home/answer/'.$inbox->q_id)}}">
                    @csrf
                    <textarea name="body" style="width: 100%;">{{$inbox->a_body}}</textarea>
                    <p><button class="btn btn-primary" type="submit">Answer</button></p>
                </form>
            </article>
            @endcomponent
        @endforeach
    </section>
    <section class="col">
        <h2>Outbox</h2>
        @foreach ($outboxes as $outbox)
            @component('components.question', ['card' => $outbox])
            @endcomponent
        @endforeach
    </section>
</div>
@endsection
