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

<section>
    <h2>Profile</h2>
    <div class="row">
        <div class="col">
            <img src="{{url($avater)}}" />
            <form method="POST" action="{{url('/home/avater')}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <label><input type="file" name="avater"/>Avater</label>
                <button class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col">
            <form method="POST" action="" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <textarea style="width: 100%;"></textarea>
                <button class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</section>


<div class="row">
    <section class="col">
        <h2>Inbox</h2>
        <div class="row">
            <section class="col">
                <h3>Answered</h3>
                @foreach ($inbox as $card)
                    @component('components.question', ['card' => $card])
                    <article>
                        <form method="POST" action="{{url('home/answer/'.$card->q_id)}}">
                            @csrf
                            <textarea name="body" style="width: 100%;">{{$card->a_body}}</textarea>
                            <p><button class="btn btn-primary" type="submit">Answer</button></p>
                            <footer><small>QID={{$card->a_id}}, {{$card->a_updated_at}}</small></footer>
                        </form>
                    </article>
                    @endcomponent
                @endforeach
            </section>
            <section class="col">
                <h3>Unanswered</h3>
                @foreach ($inbox as $card)
                    @if (!$card->a_id)
                        @component('components.question', ['card' => $card])
                        <article>
                            <form method="POST" action="{{url('home/answer/'.$card->q_id)}}">
                                @csrf
                                <textarea name="body" style="width: 100%;">{{$card->a_body}}</textarea>
                                <p><button class="btn btn-primary" type="submit">Answer</button></p>
                                <footer><small>QID={{$card->a_id}}, {{$card->a_updated_at}}</small></footer>
                            </form>
                        </article>
                        @endcomponent
                    @endif
                @endforeach
            </section>
        </div>
    </section>
    <section class="col">
        <h2>Outbox</h2>
        <div class="row">
            <section class="col">
                <h3>Answered</h3>
                @foreach ($outbox as $card)
                    @if ($outbox->a_id)
                        @component('components.question', ['card' => $card])
                        @endcomponent
                    @endif
                @endforeach
            </section>
            <section class="col">
                <h3>Unanswered</h3>
                @foreach ($outbox as $card)
                    @if (!$outbox->a_id)
                        @component('components.question', ['card' => $card])
                        @endcomponent
                    @endif
                @endforeach
            </section>
        </div>
    </section>
</div>
@endsection
