<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hotel Yuvraj DX</title>
</head>

<body>
    <h1>{{$mailData['title']}}</h1>
    <p>Your OTP for password reset is: {{$mailData['body']}}</p>
    <h5>OTP valid till 15 min only.</h5>
 
</body>
</html>