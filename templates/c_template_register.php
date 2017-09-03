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
    <?php include_once("analyticstracking.php") ?>
    <div class="container" style="height:90%">
        <div class="preload_splash" id="preload_splash">
            <div class="logo_splash">
                <span style="color: darkturquoise;">Content </span>Loading
            </div>
            <div class="loader-frame_splash">
                <div class="loader1_splash" id="loader1_splash"></div>
                <div class="loader2_splash" id="loader2_splash"></div>
            </div>
        </div>
        <div class="reg_wrap">
            <div class="transbox">
                <div class="reg-html">
                    <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">COLLEGE</label>
                    <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">ALUMNI</label>

                    <div class="reg-form">
                        <div class="reg-college">
                            <div class="form-group style-1">
                                <form id="collegeForm">
                                    <input type="text" class="form-control form-horizontal" id="col_code" placeholder="College Code*"><br>
                                    <input type="text" class="form-control form-horizontal" id="c_fname" placeholder="First Name*"><br>
                                    <input type="text" class="form-control form-horizontal" id="c_lname" placeholder="Last Name"><br>
                                    <input type="text" class="form-control form-horizontal" id="c_contact" placeholder="Contact Number*"><br>
                                    <input type="text" class="form-control form-horizontal" id="c_email" placeholder="Email Address*"><br>
                                    <input type="password" class="form-control form-horizontal" id="c_passwd" placeholder="Password(8-15 chars)*"><br>
                                    <input type="password" class="form-control form-horizontal" id="c_conf_passwd" placeholder="Confirm Password*"><br>
                                </form>
                            </div>
                            <button style="width: 90%;" type="submit" form="collegeForm" id="reg_col_btn" class="btn btn-lg btn-primary btn-block">Join us</button>
                        </div>

                        <div class="reg-alumni">
                            <div class="form-group style-1">
                                <form id="alumniForm">
                                    <input type="text" class="form-control form-horizontal" id="alu_code" placeholder="Alumni Code*"></br>
                                    <input type="text" class="form-control form-horizontal" id="a_fname" placeholder="First Name*"></br>
                                    <input type="text" class="form-control form-horizontal" id="a_lname" placeholder="Last Name"></br>
                                    <label>COURSE*</label>
                                    <select class="form-control form-horizontal" id="course" style="font-size: 18px;">
                                            <option value="mca">MCA</option>
                                            <option value="msc_app">MSc Applied Mathemetics</option>
                                            <option value="msc_swe">MSc Software Engineering</option>
                                            <option value="msc_tcs">MSc Theoretical Computer Science</option>
                                    </select><br>
                                    <input type="text" class="form-control form-horizontal" id="year" placeholder="Year of Graduation*"></br>
                                    <input type="text" class="form-control form-horizontal" id="a_contact" placeholder="Contact Number*"></br>
                                    <input type="text" class="form-control form-horizontal" id="a_email" placeholder="Email Address*"></br>
                                    <input type="password" class="form-control form-horizontal" id="a_passwd" placeholder="Password(8-15 chars)*"></br>
                                    <input type="password" class="form-control form-horizontal" id="a_conf_passwd" placeholder="Confirm Password*"><br>
                                </form>
                            </div>
                            <button id="reg_alu_btn" type="submit" form="alumniForm" style="width: 90%;" class="btn btn-lg btn-primary btn-block">Join us</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="./js/enums.js"></script>
    <script type="text/javascript" src="./js/register.js"></script>
</body>

</html>