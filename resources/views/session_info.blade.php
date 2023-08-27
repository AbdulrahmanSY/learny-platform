<!DOCTYPE html>
<html>
<style>
    body {
        background-color: #f2f2f2;
        font-family: Arial, sans-serif;
    }

    .container {
        max-width: 600px;
        margin: 0 auto;
        padding: 40px;
        text-align: center;
    }

    .logo {
        width: 150px;
        margin-bottom: 20px;
    }

    .envelope {
        background-color: #e74c3c;
        padding: 40px;
        color: #fff;
        border-radius: 10px;
    }

    .envelope.reject {
        background-color: #e74c3c;
    }

    .envelope h1 {
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .envelope h2 {
        font-size: 20px;
        margin-bottom: 20px;
    }

    .envelope-img {
        width: 120px;
        margin-bottom: 20px;
    }

    .content {
        margin-top: 20px;
        line-height: 1.5;
    }

    p {
        margin-bottom: 10px;
    }

</style>
<head>
    <title>Rejected Teacher Notification</title>
</head>
<body>
<div class="container">
    <div class="envelope">
        <h1>Dear {{$name}},</h1>
        <h1>The session is going to start</h1>
        <h2>Session ID:</h2>
        <div class="content">
            <h3>{{$session_id}}</h3>
        </div>
    </div>
</div>
</body>
</html>
