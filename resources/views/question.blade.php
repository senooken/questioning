@extends('layouts.app')

@section('content')
<section>
    @component('components.question', ['card' => $card])
        @isset ($card->a_body)
        @component('components.answer', ['card' => $card])
        @endcomponent
        @endisset
    @endcomponent
</section>
@endsection


