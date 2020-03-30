<div class="row">
    <section class="col">
        <h2>Inbox</h2>
        <div class="row">
            <section class="col">
                <h3>Answered</h3>
                @foreach ($inbox as $card)
                    @isset($card->a_id)
                        @component('components.question', ['card' => $card])
                        <article>
                            @if (request()->is('/home*'))
                            <form method="POST" action="{{url('home/answer/'.$card->q_id)}}">
                                @csrf
                                <textarea name="body" style="width: 100%;">{{$card->a_body}}</textarea>
                                <p><button class="btn btn-primary" type="submit">Answer</button></p>
                                <footer><small>QID={{$card->a_id}}, {{$card->a_updated_at}}</small></footer>
                            </form>
                            @endif
                        </article>
                        @endcomponent
                    @endisset
                @endforeach
            </section>
            <section class="col">
                <h3>Unanswered</h3>
                @foreach ($inbox as $card)
                    @empty($card->a_id)
                        @component('components.question', ['card' => $card])
                        <article>
                            @if (request()->is('/home*'))
                            <form method="POST" action="{{url('home/answer/'.$card->q_id)}}">
                                @csrf
                                <textarea name="body" style="width: 100%;">{{$card->a_body}}</textarea>
                                <p><button class="btn btn-primary" type="submit">Answer</button></p>
                                <footer><small>QID={{$card->a_id}}, {{$card->a_updated_at}}</small></footer>
                            </form>
                            @endif
                        </article>
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
                    @isset($outbox->a_id)
                        @component('components.question', ['card' => $card])
                        @endcomponent
                    @endisset
                @endforeach
            </section>
            <section class="col">
                <h3>Unanswered</h3>
                @foreach ($outbox as $card)
                    @empty($outbox->a_id)
                        @component('components.question', ['card' => $card])
                        @endcomponent
                    @endempty
                @endforeach
            </section>
        </div>
    </section>
</div>
