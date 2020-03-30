@extends('layouts.app')

@section('content')

@component('components.profile', ['is_home' => 'true', 'user' => $user])
@endcomponent

@component('components.box', ['inbox' => $inbox, 'outbox' => $outbox])
@endcomponent

@endsection
