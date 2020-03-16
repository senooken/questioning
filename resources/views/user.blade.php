<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>{{$user}}</title>
  </head>
  <body>
    <p>hi {{$user}}</p>
    <form action="{{url('user/'.$user.'/question')}}" method="POST">
      @csrf
      <textarea name="body"></textarea>
      <button type="submit">Question</button>
    </form>
  </body>
</html>
