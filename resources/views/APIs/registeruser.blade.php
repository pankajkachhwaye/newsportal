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
    URL::   {{url('/').'/api/register-app-user'}}

</h1>
<form method="POST" action="{{url('/api/register-app-user')}}" >


    full_name ::*<input type="text"  name="full_name" >

    <br />
    email ::*<input type="email" name="email" >
    <br />


    password ::  * <input type="password" name="password" placeholder="Password">
    <br />

    mobile_no ::*<input type="text"  name="mobile_no" >
    <br />

    device_id ::*<input type="text"  name="device_id" >
    <br />
    device_token ::*<input type="text"  name="device_token" >
    <br />
    device_type ::*<input type="text"  name="device_type" >
    <br />
    login_with ::*<input type="text"  name="login_with" >
    <br />



    <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">REGISTER</button>

</form>


</body>
</html>