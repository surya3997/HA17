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
    <link rel='stylesheet prefetch' href='./css/general/opensans.css'>
    <link rel="stylesheet" href="./css/general/bootstrap.min.css">

    <script src="./js/general/jquery.min.js"></script>

    <link rel="stylesheet" href="css/register.css">

</head>

<body id="register">
    <div class="container" style="height:90%">
        <div class="reg_wrap">
            <div class="transbox">
                <div class="reg-html">
                    <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">COLLEGE</label>
                    <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">ALUMNI</label>

                    <div class="reg-form">

                        <div class="sign-in-htm">
                            <div class="form-group style-1">
                                <form>
                                    <input type="text" class="form-control form-horizontal" id="col_code" placeholder="College Code*"><br>
                                    <input type="text" class="form-control form-horizontal" id="fname" placeholder="First Name*"><br>
                                    <input type="text" class="form-control form-horizontal" id="lname" placeholder="Last Name"><br>
                                    <input type="text" class="form-control form-horizontal" id="contact" placeholder="Contact Number*"><br>
                                    <input type="text" class="form-control form-horizontal" id="email" placeholder="Email Address*"><br>
                                    <input type="password" class="form-control form-horizontal" id="passwd" placeholder="Password(8-15 chars)*"><br>
                                    <input type="password" class="form-control form-horizontal" id="conf_passwd" placeholder="Confirm Password*"><br>
                                </form>
                            </div>
                            <a href="" class="btn btn-lg btn-primary btn-block">Join us</a>
                        </div>

                        <div class="sign-up-htm">
                            <div class="form-group style-1">
                                <form>
                                    <input type="text" class="form-control form-horizontal" id="alu_code" placeholder="Alumni Code*"></br>
                                    <input type="text" class="form-control form-horizontal" id="fname" placeholder="First Name*"></br>
                                    <input type="text" class="form-control form-horizontal" id="lname" placeholder="Last Name"></br>
                                    <label>COURSE*</label>
                                    <select class="form-control form-horizontal" id="course" style="font-size: 18px;">
											<option value="mca">MCA</option>
											<option value="msc_app">MSc Applied Mathemetics</option>
											<option value="msc_swe">MSc Software Engineering</option>
											<option value="msc_tcs">MSc Theoretical Computer Science</option>
										</div>
									</select><br>
                                    <input type="text" class="form-control form-horizontal" id="year" placeholder="Year of Graduation*"></br>
                                    <input type="text" class="form-control form-horizontal" id="contact" placeholder="Contact Number*"></br>
                                    <input type="text" class="form-control form-horizontal" id="email" placeholder="Email Address*"></br>
                                    <input type="password" class="form-control form-horizontal" id="passwd" placeholder="Password(8-15 characters)*"></br>
                                    <input type="password" class="form-control form-horizontal" id="conf_passwd" placeholder="Confirm Password*"><br>
                                </form>
                            </div>
                            <a href="" class="btn btn-lg btn-primary btn-block">Join us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>