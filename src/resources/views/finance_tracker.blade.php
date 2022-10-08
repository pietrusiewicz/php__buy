<!DOCTYPE html>
<html>
<head>
<title>A finance tracker</title>
</head>
<body>
    @include('profile')
    <h1>track your finances</h1>
    <h3>Your bought things:</h3>
    <ol>
        @foreach ($bought_things as $thing)
        <li>
            {{$thing[0]}} - 
            {{$thing[1]}}
            <!--<input type='submit' value='-' name='{{ $i }}'/>-->
        </li>

        @endforeach
        
        <form method="post" action="append_bought_thing/">
            @csrf
            <li><input type="text" name="item_name"/>
            <input type="number" name="price"/>
            <input type="submit" value="+"/></li>
        </form>
    </ol>
    <h4>Summary: 
        <?php  
        function index2nd($arr1) {
            $l = [];
            foreach($arr1 as $index1_index2)
            {
                array_push($l, $index1_index2[1]);
            }
            return $l;
        }        
        echo array_sum(index2nd($bought_things)); ?></h4>
</body>
</html>
