<!DOCTYPE html>
<html>
<head>
    <title>profile: {{ $user }}</title>
</head>
<body>
    <h1>username: {{ $user }} <a href="/profile/logout/">logout</a></h1>
    <h2>Todolist</h2>
    <ol>
        @for ($i=0; $i<count($items); $i++) 
            <form method='post' action='del_item/'>
                @csrf
                <li>{{$items[$i]}}<input type='submit' value='-' name='{{ $i }}'/></li>
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
