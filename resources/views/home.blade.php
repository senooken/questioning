@extends('layouts.app')

@section('content')
<h1>Home</h1>

@component('components.profile', ['is_home' => 'true', 'user' => $user])
@endcomponent

@component('components.box', ['inbox' => $inbox, 'outbox' => $outbox])
@endcomponent

@endsection
