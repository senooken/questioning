<article class="card">
    <figure class="card-header">
        <header>
            @isset ($card->q_name)
            <a href="{{url('/user/'.$card->q_name)}}">
            <img src="{{\Storage::disk('public')->url(App\User::where('name', $card->q_name)->first()->avatar)}}"
                 style="height: 3em;"
            />
            {{$card->q_name}}
            </a>
            , <small>{{$card->q_created_at}}
            , <a href="{{url('/question/' . $card->q_id)}}">permalink</a>
            </small>
            @endisset
        </header>
        <blockquote>
            <p>{{$card->q_body}}</p>
        </blockquote>
    </figure>
    {{$slot}}
</article>
