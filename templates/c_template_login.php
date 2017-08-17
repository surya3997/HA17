<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/general/bootstrap.min.css">
    <script src="./js/general/jquery.min.js"></script>
    <script src="./js/general/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./css/login.css">
</head>

<body id="login">
    <div class="container" style="height:90%">
        <div class="login-wrap">
            <div class="transbox">
                <div class="login-html">
                    <div class="login-form">
                        <center>
                            <h1 style="color:white">WELCOME</h1>
                        </center><br>
                        <form class="form-horizontal" id="formLogin">
                            <input type="text" class="form-control form-rounded transparent-input" id="email" placeholder="Email Address"><br>
                            <input type="password" class="form-control form-rounded transparent-input" id="passwd" placeholder="Password"><br>
                        </form>
                        <div class="game_btn">
                            <button id="login_btn" form="formLogin" class="btn btn-lg btn-primary btn-block">Game on</button>
                        </div>
                        <br>
                        <br>
                        <div class="redirections">
                            <label>Don't have an account ?</label>
                            <span><a href="register.php">Register here</a></span>
                            <br>
                            <br>
                            <label>Didn't get an activation email ?</label>
                            <a href="resend.php">Click here</a>
                        </div>
                        <br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="js/login.js"></script>
</body>

</html>