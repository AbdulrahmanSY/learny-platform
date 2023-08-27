<!DOCTYPE html>
<html>
<head>
    <title>Verification Code</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }

        .container {
            width: 50%;
            margin: 0 auto;
            text-align: center;
            margin-top: 50px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.2);
            padding: 20px;
        }

        h1 {
            color: #337ab7;
            font-size: 32px;
            margin-top: 0;
        }

        p {
            color: #666;
            font-size: 18px;
        }

        .otp {
            display: inline-block;
            font-size: 36px;
            color: #337ab7;
            margin-top: 10px;
            padding: 10px;
            border-radius: 5px;
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Verification Code</h1>
    <p>Please enter the following code to verify your email address:</p>
    <span class="otp">{{$otp}}</span>
</div>
</body>
</html>
