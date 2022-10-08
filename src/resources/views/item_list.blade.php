<!DOCTYPE html>
<html>
<head>
<title>Todolist</title>
</head>
<body>
    @include('profile')
    <h2>Todolist</h2>
    <ol>
        @for ($i=0; $i<count($todolist); $i++) 
            <form method='post' action='del_item/'>
                @csrf
                <li>{{$todolist[$i]}}<input type='submit' value='-' name='{{ $i }}'/></li>
            </form>

        @endfor
        
        <form method="post" action="add_item/">
            @csrf
            <li><input type="text" name="item_name"/>
            <input type="submit" value="+"/></li>
        </form>
    </ol>
</body>
</html>
