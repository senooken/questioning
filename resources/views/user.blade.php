@extends('layouts.app')

@section('content')
<h1>User</h1>

<table>
    <thead>
        <tr>
            <th>avatar</th>
            <th>name</th>
            <th>created_at</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td><img src="{{\Storage::disk('public')->url($user->avatar)}}" style="height: 3em;"/></td>
                <td><a href="{{url('user/'.$user->name)}}">{{$user->name}}</a></td>
                <td>{{$user->created_at}}</td>
                <td></td>
            </tr>
        @endforeach
    </tbody>
</table>


@endsection
