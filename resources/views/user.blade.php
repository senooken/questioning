@extends('layouts.app')

@section('content')
<h1>{{$user->name}}</h1>

@component('components.profile', ['user' => $user])
@endcomponent

<section>
    <h2>Question form</h2>
    <form method="POST" action="{{url('user/'.$user->name.'/question')}}">
        @csrf
        <textarea name="body" style="width: 100%;"></textarea>
        <p><button class="btn btn-primary" type="submit">Question</button></p>
    </form>
</section>

<div class="row">
    <section class="col">
        <h2>Inbox</h2>
        <div class="row">
            <section class="col">
                <h3>Answered</h3>
                @foreach ($inbox as $card)
                    @isset($card->a_id)
                        @component('components.question', ['card' => $card])
                            @component('components.answer', ['card' => $card])
                            @endcomponent
                        @endcomponent
                    @endisset
                @endforeach
            </section>
            <section class="col">
                <h3>Unanswered</h3>
                @foreach ($inbox as $card)
                    @empty($card->a_id)
                        @component('components.question', ['card' => $card])
                        @endcomponent
                    @endempty
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
                    @isset($card->a_id)
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
                    @empty($card->a_id)
                        @component('components.question', ['card' => $card])
                        @endcomponent
                    @endempty
                @endforeach
            </section>
        </div>
    </section>
</div>
@endsection
