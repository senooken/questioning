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
    <section>
        <h2>Inbox</h2>
        <div class="row">
            <section class="col">
                <h2>Answered</h2>
                @foreach ($inbox as $card)
                    @if ($card->a_id)
                        @component('components.question', ['card' => $card])
                            @component('components.answer', ['card' => $card])
                            @endcomponent
                        @endcomponent
                    @endif
                @endforeach
            </section>
            <section class="col">
                <h2>Unanswered</h2>
                @foreach ($inbox as $card)
                    @if (!$card->a_id)
                        @component('components.question', ['card' => $card])
                        @endcomponent
                    @endif
                @endforeach
            </section>
        </div>
    </section>
    <section>
        <h2>Outbox</h2>
        <div class="row">
            <section class="col">
                <h3>Answered</h3>
                @foreach ($outbox as $card)
                    @if ($card->a_id)
                        @component('components.question', ['card' => $card])
                            @component('components.answer', ['card' => $card])
                            @endcomponent
                        @endcomponent
                    @endif
                @endforeach
            </section>
            <section class="col">
                <h3>Unanswered</h3>
                @foreach ($outbox as $card)
                    @if (!$card->a_id)
                        @component('components.question', ['card' => $card])
                        @endcomponent
                    @endif
                @endforeach
            </section>
        </div>
    </section>
</div>
@endsection
