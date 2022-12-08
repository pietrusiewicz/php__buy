<!DOCTYPE html>
<html>
  <head>
    <title>pizzas</title>
  </head>
  <body>
    <ol>
      @foreach($pizzas as $pizza)
        <li>{{$pizza['type']}} -- {{$pizza['base']}}</li>
      @endforeach
    </ol>
  </body>
</html>
