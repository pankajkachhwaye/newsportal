<html>
<head>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>

<body>
<h1>
    URL::   {{url('/').'/api/forgot-password'}}

</h1>
<form  method="post"  action=" {{url('/api/forgot-password')}}" >

    <br>
    Token(token) ::*<input type="text"  name="token" >


    <br>
    <br>

    <button type="submit">Submit</button>




</form>

</body>
</html>