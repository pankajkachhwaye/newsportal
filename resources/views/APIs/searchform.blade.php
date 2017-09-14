<html>
<head>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>

<body>
<h1>
    URL::   {{url('/').'/api/search-news'}}

</h1>
<form  method="post"  action=" {{url('/api/search-news')}}" >

    <br>
    Value(value) ::*<input type="text"  name="value" >


    <br>
    <br>


    <br>
    <br>
    <button type="submit">Submit</button>




</form>

</body>
</html>