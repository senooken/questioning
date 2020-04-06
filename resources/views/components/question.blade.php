<article class="card">
    <figure class="card-header">
        <header>
            @isset ($card->q_username)
            <img src="{{\Storage::disk('public')->url(App\User::where('name', $card->q_username)->first()->avatar)}}"
                 style="height: 3em;"
            />
            {{$card->q_username}}
            @endisset
        </header>
        <blockquote>
            <p>{{$card->q_body}}</p>
        </blockquote>
        <footer><small>{{$card->q_created_at}},
            <a href="{{url('/question/' . $card->q_id)}}">permalink</a>
        </small></footer>
    </figure>
    {{$slot}}
</article>
