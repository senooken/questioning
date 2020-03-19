<article class="card">
    <figure class="card-header">
        <blockquote>
            <p>{{$card->q_body}}</p>
        </blockquote>
        <footer><small>QID={{$card->q_id}}, {{$card->q_created_at}}</small></footer>
    </figure>
    {{$slot}}
</article>
