<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

<head>
    <title>Registration</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./res/logo/ms-icon-150x150.png">
    <link rel='stylesheet prefetch' href='./css/general/opensans.css'>
    <link rel="stylesheet" href="./css/general/bootstrap.min.css">
    <script src="./js/general/jquery.min.js"></script>
    <link rel="stylesheet" href="css/register.css">

</head>

<body id="register">
        <div class="reg_wrap">
            <div class="transbox">
                <div class="reg-html">
                    <div class="reg-form">
                        <center>
                            <h1 style="color:white">WELCOME</h1>
                        </center><br>
                        <div class="reg-college">
                            <div class="form-group style-1" id="noScroller">
                                <form id="collegeForm">
                                    <input type="text" class="form-control form-horizontal" id="col_code" placeholder="Login Key*"><br>
                                    <input type="text" class="form-control form-horizontal" id="c_email" placeholder="Email Address*"><br>
                                    <input type="password" class="form-control form-horizontal" id="c_passwd" placeholder="Set Password*"><br>
                                    <input type="password" class="form-control form-horizontal" id="c_conf_passwd" placeholder="Confirm Password*"><br>
                                </form>
                            </div>
                            <button style="width: 90%;" type="submit" form="collegeForm" id="reg_col_btn" class="btn btn-lg btn-primary btn-block">Join us</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script type="text/javascript" src="./js/enums.js"></script>
    <script type="text/javascript" src="./js/register1.js"></script>
</body>

</html>
