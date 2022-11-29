<!DOCTYPE html>
<html>
<head>
<title>A finance tracker</title>
</head>
<body>
    @include('profile')
    <h1>Edit your finance log</h1>
    <h3>Your bought things:</h3>
    <ol>
        <form method="POST" action="/finance_tracker/edit">
            @csrf
            @for ($i=0; $i<count($bought_things); $i++)

            <li>
                <input type="text" name="name{{$i}}" value="{{$bought_things[$i][0]}}"> &nbsp
                <input type="number" name="nr{{$i}}" value="{{$bought_things[$i][1]}}">
                <a href="/finance_tracker/delete/{{$i}}">
                    <input type="button" value="-"/>
                </a>
            </li>
            @endfor

                <input type="submit" value="confirm edit"/>
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
