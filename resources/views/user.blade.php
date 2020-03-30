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

@component('components.box', ['inbox' => $inbox, 'outbox' => $outbox])
@endcomponent

@endsection
