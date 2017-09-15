<html>
<head>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>

<body>
<h1>
    URL::   {{url('/').'/api/news'}}

</h1>
<form  method="post"  action=" {{url('/api/news')}}" >

    <br>
    Language(language) ::    *<select required name="language" >
        <option value="" >Please Select</option>
        @foreach($laguages as $d)
            <option value="{{$d['id']}}" >{{$d['language_name']}}</option>

        @endforeach
    </select>


    <br>
    <br>

    Category(cat_id) ::    *<select name="cat_id" >
        <option value="" >Please Select</option>
        @foreach($categories as $d)
        <option value="{{$d['id']}}" >{{$d['category_name']}}</option>

        @endforeach
    </select>


    <br>
    <br>
    TopNews(top_news) ::*<input type="text"  name="top_news" >
    <br>
    <br>

    Recommnded News(recommended_news) ::*<input type="text"  name="recommended_news" >
    <br>
    <br>

    User Id(user_id) ::*<input type="text"  name="user_id" >
    <br>
    <br>
    <button type="submit">Submit</button>




</form>

</body>
</html>