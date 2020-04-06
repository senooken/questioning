<article>
    <figure>
        @isset ($card->a_username)
        <a href="{{url('/user/'.$card->a_username)}}">
        <img src="{{\Storage::disk('public')->url(App\User::where('name', $card->a_username)->first()->avatar)}}"
             style="height: 3em;"
        />
        {{$card->a_username}}
        </a>
        @endisset
        <blockquote><p>{{ $card->a_body }}</p></blockquote>
        <footer><small>{{ $card->a_updated_at }}</small></footer>
    </figure>
</article>
