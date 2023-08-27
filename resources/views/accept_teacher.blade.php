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
<head>
    <title>Accepted Teacher Invitation</title>
</head>
<body>
<div class="container">
    <div class="envelope">
        <h1>Welcome to Our Platform!</h1>
        <h2>Join our community of exceptional educators</h2>
        <div class="content">
            <p>Dear {{$teacher_name}},</p>
            <p>Congratulations! You have been accepted to join our platform as a teacher. We are thrilled to have you on board and look forward to the positive impact you'll make on our students.</p>
        </div>
    </div>
</div>
</body>
</html>
