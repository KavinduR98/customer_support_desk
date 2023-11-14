<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

<head>
    <title>CSD</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/x-icon" href="images/icon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="assets/css/login_styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="assets/js/login.js" ?random=<?php echo uniqid(); ?>></script>
</head>

<body class="bg-image" style="background-image: url('images/back2.jpg');">

    <div class="row m-0 p-3 vh-100 vw-100">
        <div class="col-12 col-md-8 col-lg-4 blur rounded d-flex justify-content-center align-items-center  p-md-5 p-2 ps-4 pe-4 col-30">

            <form method="post" action="#" name="login" class="vw-100 p-md-3 p-2 ">
                <div style="text-align: center;">
                    <img src="images/logo.png" class="img-w">
                </div>
                <div class="form-group-lg pb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control form-control-md" id="txtEmail" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control form-control-md" id="txtPassword" placeholder="Password">
                </div>
                <div class="form-group-lg form-check mt-3 mb-3">
                    <input type="checkbox" class="form-check-input" id="rememberMe">
                    <span class="d-flex justify-content-between">
                        <label class="form-check-label small" for="rememberMe">Remember Me</label>
                        <small><a href="#" class="txtforget">Forgot Password?</a></small>
                    </span>
                </div>
                <label id="lblMessage" style="color: red;" class="danger"></label>
                <input type="button" id="submitform" class="btn btn-primary" value="Login" style="background-color: #2874a6; font-size:18px">
            </form>
        </div>
    </div>
</body>
</html>