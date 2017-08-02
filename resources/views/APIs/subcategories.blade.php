<html>
<head>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>

<body>


<form  method="post"  action=" {{url('/api/subcategories')}}" >

    Select Categories (cat_id):<select name="cat_id" class="">
        <option> --select Discussion Topic --</option>
        @foreach($data as $d)
            <option value="{{$d['id']}}">{{$d['categories_name']}} </option>
        @endforeach
    </select>


    <br>
    <br>

    <br>
    <input type="submit" name="Submit">
    <input type="reset" name="Reset">



</form>

</body>
</html>