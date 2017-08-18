<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Api-Panel</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

</head>
<body>
<h1>
    URL::   {{url('/').'/api/categories-by-language'}}

</h1>
<form method="POST" action="{{url('/api/categories-by-language')}}" >


    Seeker(language_id) :: <select name="language_id">

        @foreach($laguages as $key_seeker => $value_seeker)
            <option value="{{$value_seeker['id']}}">{{$value_seeker['language_name']}}</option>
        @endforeach
    </select>
    <br />
    <br />




    <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">Submit</button>

</form>


</body>
</html>