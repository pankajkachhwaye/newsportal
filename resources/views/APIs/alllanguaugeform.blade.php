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
    URL::   {{url('/').'/api/all-languages'}}

</h1>
<form method="POST" action="{{url('/api/all-languages')}}" >



    device_id ::*<input type="text"  name="device_id" >
    <br />
    device_token ::*<input type="text"  name="device_token" >
    <br />
    device_type ::*<input type="text"  name="device_type" >
    <br />


    <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">All Languauges</button>

</form>


</body>
</html>