<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

<head>
    <title>Resend Activation</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./res/logo/ms-icon-150x150.png">
    <link rel="stylesheet" href="./css/general/bootstrap.min.css">
    <script src="./js/general/jquery.min.js"></script>
    <script src="./js/general/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./css/login.css">
</head>

<body id="resend">
    <?php include_once("analyticstracking.php") ?>
    <div class="container" style="height:90%">
        <div class="login-wrap">
            <div class="transbox">
                <div class="login-html">
                    <div class="login-form">
                        <center>
                            <h1 style="color:white">Resend Activation</h1>
                        </center><br>
                        <form class="form-horizontal" id="resend_form">
                            <input type="text" class="form-control form-rounded transparent-input" id="activ_name" placeholder="Email Address*"><br>
                            <input type="text" class="form-control form-rounded transparent-input" id="activ_code" placeholder="College/Alumni Code*"><br>
                        </form>
                        <div class="game_btn">
                            <button id="send_mail_btn" form="resend_form" class="btn btn-lg btn-primary btn-block">Resend Email</button>
                        </div>
                        <br>
                        <br>
                        <div class="redirections">
                            <label>Don't have an account ?</label>
                            <span><a href="register.php">Register here</a></span>
                            <br>
                        </div>
                        <br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="js/general/jquery.js"></script>
    <script type="text/javascript" src="js/general/jquery-ui.min.js"></script>
    <script type="text/javascript" src="js/ha_resend.js"></script>
</body>

</html>
