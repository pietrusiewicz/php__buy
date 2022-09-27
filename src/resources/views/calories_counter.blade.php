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
    @if (count($foods)>0)
        @foreach (array_keys($foods) as $key)
	<?php $i++; ?>
	<form method="post" action="del_food/">
            <li>{{ $key }}<input type='submit' value='-' name='{{ $i }}'/></li>
	</form>
        @endforeach
    @endif
	<li>
        <form method='post' action='add_food/'>
            @csrf
	    <input type="text" name="food_name"/>
	    <input type="number" name="calories"/>
	    <input type='submit' value='+'/>
        </form>
	</li>
    </ol>

<?php $i = 0; ?>
    <ol>
    @if ($ate_foods)
        @foreach (array_keys($ate_foods) as $key)
	<?php $i++; ?>
	<form method="post" action="add_food/">
            <li>{{ $key }}<input type='submit' value='-' name='{{ $i }}'/></li>
	</form>
        @endforeach
    @endif
	<form>
	    <li><input type="number" name="nr"/></li>
	</form>
    </ol>
</body>
</html>

