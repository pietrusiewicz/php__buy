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
<div class="lists">
    <div class="list1" style="float:left;">
    <h2>Foods</h2>
    <ol>
    @if (count($foods)>0)
	@foreach (array_keys($foods) as $key)
	<?php $i++; ?>
	<form method="post" action="del_food/">
	    @csrf
	    <li>{{ $key }}- {{ $foods[$key]["cals"] }}kcal<input type='submit' value='-' name='{{ $i }}'/></li>
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
    </div>
    <?php $i = 0; ?>

    <h2>Ate Foods</h2>
    <ol style="float:left;">
    @if ($ate_foods)
	@foreach (array_keys($ate_foods) as $key)
	<?php $i++; ?>
	<form method="post" action="del_cal/">
	    @csrf
	    <li>{{ $key }}<input type='submit' value='-' name='{{ $i }}'/></li>
	</form>
	@endforeach
    @endif
	<li>
	<form method="POST" action="add_cal">
	    @csrf
	    <input type="number" name="food_nr"/>
	    <input type='submit' value='+'/>
	</form>
	</li>
    </ol>
</div>
</body>
</html>

