<html>
<head>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>

<body>


<form  method="post"  action=" {{url('/api/news')}}" >

        @foreach($data as $d)
            <input type="checkbox" name="categories[]" value="{{$d['id']}}">{{$d['categories_name']}}<br>
        @endforeach
<br>

    <select name="language" >
        <option value="" >All</option>
        <option value="0">hindi</option>
        <option value="1">English</option>
    </select>



    {{--<input type="checkbox" name="vehicle[]" value="Bike">I have a bike<br>--}}
    {{--<input type="checkbox" name="vehicle[]" value="Car">I have a car--}}
    {{--<input type="checkbox" name="vehicle[]" value="plane">I have a plane--}}


    <br>
    <br>

    <br>
    <input type="submit" name="Submit">
    <input type="reset" name="Reset">



</form>

</body>
</html>