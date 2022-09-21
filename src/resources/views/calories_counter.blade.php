<!DOCTYPE html>
<html>
<head>
    <title>calories counter</title>
    <style>
	ol {
	  width:40%;
	}
    </style>
</head>
<body>
    @include('profile')
    <h1>Calories counter</h1>
    <ol>
        @for ($i=0; $i<count($foods); $i++) 
	<form method="post" action="del_food/">
            <li>{{$foods[$i]}}<input type='submit' value='-' name='{{ $i }}'/></li>
	</form>
        @endfor
	<li>
        <form method='post' action='add_food/'>
            @csrf
	    <input type="text" name="food_name"/>
	    <input type="number" name="calories"/>
	    <input type='submit' value='+'/>
        </form>
	</li>

    </ol>

    <div style="clear:both;"></div>

    <ol>
        @for ($i=0; $i<count($ate_foods); $i++)
        <form method='post' action='del_cal/'>
            @csrf
            <li>{{$ate_foods[$i]}}<input type='submit' value='-' name='{{ $i }}'/></li>
        </form>
        @endfor
	<form>
	    <li><input type="number" name="nr"/></li>
	</form>
    </ol>
</body>
</html>

