<?php
/**
 * Created by PhpStorm.
 * User: coder
 * Date: 10/9/17
 * Time: 10:27 AM
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h1>You are getting request from following people</h1><br>
<h1><?= $email ?></h1>
    <h1><?= $dauA ?></h1>
    <button type="button" class="btn btn-success">ACCEPT</button>
    <button type="button" class="btn btn-danger">DENY</button>
</div>

</body>
</html>

