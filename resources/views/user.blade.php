<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>{{$username}}</title>
  </head>
  <body>
    <p>hi {{$username}}</p>
    <form method="POST" action="{{url('user/'.$username.'/question')}}">
      @csrf
      <textarea name="body"></textarea>
      <button type="submit">Question</button>
    </form>
  </body>
</html>
