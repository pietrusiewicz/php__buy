<!DOCTYPE html>
<html>
<head>
<title>rejestracja</title>
</head>
<body>
<h1>Create your account</h1>
<form action="/register" method="POST">
	@csrf
	<input type='text' id='passwd' name='usname'/>
	<input type='password' id='usname' name='usname'/>
	<input type="submit" value="register"/>
</form>
</body>
</html>
