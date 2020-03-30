@extends('layouts.app')

@section('content')

<section class="card">
    <h2 class="card-header">Profile</h2>
    <div class="row">
        <div class="col">
            <img src="{{$avatar}}" style="width: 20em;" />
            <form method="POST" action="/home/avatar" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <label><input type="file" name="avatar"/>avatar</label>
                <button class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col">
            <table>
                <tbody>
                <tr><td>Username</td><td>{{$user->name}}</td></tr>
                    <tr><td>Nickname</td><td>Nickname</td></tr>
                    <tr><td>Web</td><td>Web</td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <form method="POST" action="/home/profile" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <textarea name="profile" style="width: 100%; height: 20em;">{{$user->profile}}</textarea>
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
