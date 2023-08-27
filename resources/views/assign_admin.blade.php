<!DOCTYPE html>
<html>
<head>
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
            background-color: #28a745;
            padding: 40px;
            color: #fff;
            border-radius: 10px;
        }

        .envelope.admin {
            background-color: #28a745;
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
    <title>Admin Assignment</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<div class="container">
    <div class="envelope admin">
        <h1>Congratulations!</h1>
        <h2>You have been assigned as an admin</h2>
        <div class="content">
            <p>Dear {{$user_name}},</p>
            <p>Congratulations! We are delighted to inform you that you have been assigned as an admin in our platform. Your valuable contribution and expertise will help shape the future of our community. We are excited to have you on board!</p>
        </div>
    </div>
</div>
</body>
</html>
