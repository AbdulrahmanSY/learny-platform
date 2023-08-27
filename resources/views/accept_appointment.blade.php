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
        background-color: #1e6ea7;
        padding: 40px;
        color: #fff;
        border-radius: 10px;
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
<body>
<div class="container">
    <div class="envelope">
        <h1>Your appointment is accepted</h1>
        <div class="content">
            <p>Dear {{$user_name}},</p>
            <p>Thank you for choice us, we hope get great lesson</p>
        </div>
    </div>
</div>
</body>
</html>
