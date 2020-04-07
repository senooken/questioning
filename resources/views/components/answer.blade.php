<article>
    <figure>
        @isset ($card->a_name)
        <a href="{{url('/user/'.$card->a_name)}}">
        <img src="{{\Storage::disk('public')->url(App\User::where('name', $card->a_name)->first()->avatar)}}"
             style="height: 3em;"
        />
        {{$card->a_name}}
        </a>
        , <small>{{ $card->a_updated_at }}</small>
        @endisset
        <blockquote><p>{{ $card->a_body }}</p></blockquote>
    </figure>
</article>
