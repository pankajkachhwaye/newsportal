<html>
<head>Test APis</head>

<body>

<form  method="post" action="{{URL('/api/insert')}}">
    {{csrf_field()}}
   Email : <input type="text" name="email"  ><br>
   Password : <input type="password" name="password" ><br>
    <input type="submit" value="Submit">
</form>

</body>
</html>