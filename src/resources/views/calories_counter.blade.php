<!DOCTYPE html>
<html>
<head>
    <title>calories counter</title>
</head>
<body>
    @include('profile')
    <h1>Calories counter</h1>
    <ul>
        @for ($i=0; $i<count($foods); $i++) 
	    <li>{{ $foods[$i] }}</li>
        @endfor
	<li>
        <form method='post' action='add_food/'>
            @csrf
	    <input type="text" name="food_name"/>
	    <input type="number" name="calories"/>
	    <input type='submit' value='+'/>
        </form>
	</li>

    </ul>
    <hr/>
    <ol>
        @for ($i=0; $i<count($foods); $i++)
        <form method='post' action='del_cal/'>
            @csrf
            <li>{{$foods[$i]}}<input type='submit' value='+' name='{{ $i }}'/></li>
        </form>

        @endfor

    </ol>
</body>
</html>

