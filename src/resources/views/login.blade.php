<!DOCTYPE html>
<html>
<head>
<title>tytuł</title>
</head>
<body>
<h1>login</h1>
<form method="POST" action="/">
    @csrf
    <input type="text" name="usname"/>
    <input type="password" name="passwd"/>
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <input type="submit" value="Log in"/>
</form>
<p>{{ $info }}</p>
</body>
</html>
