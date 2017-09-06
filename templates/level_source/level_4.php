            <div id="separate" style="height:550px;">
                <div class="wrapper" id='malaysia_html'>
                    <div class="row row-offcanvas row-offcanvas-left">
                        <div class="column col-sm-12 col-xs-11" id="main" style="width:60%">
                            <div class="navbar navbar-blue navbar-static-top">
                                <div class="navbar-header">
                                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                                    <a class="navbar-brand logo">f</a>
                                </div>
                                <nav class="collapse navbar-collapse" role="navigation">
                                    <div class="navbar-form navbar-left">
                                        <div class="input-group input-group-sm" style="max-width:360px;">
                                            <input class="form-control" placeholder="Search" name="srch-term" id="srch-term" type="text">
                                            <div class="input-group-btn">
                                                <button class="btn btn-default" ><i class="glyphicon glyphicon-search" href="#"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="nav navbar-nav" style="margin-left: 10%;">
                                        <li>
                                            <a href="#"><i class="glyphicon glyphicon-home"></i> Home</a>
                                        </li>
                                        <li>
                                            <a href="#postModal" role="button" data-toggle="modal"><i class="glyphicon glyphicon-plus"></i> Post</a>
                                        </li>
                                        <li>
                                            <a href="#postModal2" role="button" data-toggle="modal"><span class="badge">Log Out</span></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="padding">
                                <div class="full col-sm-9">
                                    <div class="row">
                                        <div class="col-sm-10" style="margin-left:7%">
                                            <B style="color:#357ebd">Steve</B> updated his profile picture
                                            <br>
                                            <p style="color:gray">26 mins ago</p>
                                            <div class="panel panel-default">
                                                <div class="panel-thumbnail"><img src="./res/images/levels/level4/hack.jpg" class="img-responsive"></div>
                                                <div class="panel-body">
                                                    <p class="lead">To Beat A Hacker , <br> You Have To Become One</p>
                                                    <p>45 Followers, 13 Posts</p>
                                                    <p></p>
                                                    <img src="./res/images/levels/level4/user.png" height="28px" width="28px"> Sudhir
                                                    <p></p>
                                                    <p><textarea value="Remove the Comment" readonly style="background-color: #9cb4d8;width: 93%;margin-left: 0%;border-radius: 4%;/* height: 10%; */">f**k*** B****</textarea></p>

                                                    <p>
                                                        <img src="./res/images/levels/level4/user.png" height="28px" width="28px"> Steve
                                                        <p></p>
                                                        <p><textarea value="Remove the Comment" readonly style="background-color: #9cb4d8;width: 93%;margin-left: 0%;border-radius: 4%;/* height: 10%; */">Hey Idiot! Remove The Comment</textarea></p>
                                                    </p>
                                                    <p>
                                                        <img src="./res/images/levels/level4/user.png" height="28px" width="28px"> User
                                                        <p></p>
                                                        <p><textarea id="remove" onfocus="fn()" value="Remove the Comment" style="background-color: #e7e7e7;color:gray;width: 93%;margin-left: 0%;border-radius: 4%;/* height: 10%; */">Type The Comment!    </textarea></p>
                                                    </p>
                                                    <button type="button" class='btn' >post</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- sudhir's password is  <?php $this->printVar('level_question'); ?>. -->
                            <div id="postModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button> Update Status
                                        </div>
                                        <div class="modal-body">
                                            <form class="form center-block">
                                                <div class="form-group">
                                                    <textarea class="form-control input-lg" autofocus="" placeholder="What do you want to share?"></textarea>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <div>
                                                <button class="btn btn-primary btn-sm" data-dismiss="modal" aria-hidden="true">Post</button>
                                                <ul class="pull-left list-inline">
                                                    <li><a href=""><i class="glyphicon glyphicon-upload"></i></a></li>
                                                    <li><a href=""><i class="glyphicon glyphicon-camera"></i></a></li>
                                                    <li><a href=""><i class="glyphicon glyphicon-map-marker"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="postModal2" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button> Login
                                        </div>
                                        <div class="modal-body">
                                            <form id="form_id" method="post" name="myform">
                                                <label>User Name :</label>
                                                <input type="text" name="username" id="fbusername" />
                                                <label>Password :</label>
                                                <input type="password" name="password" id="fbpassword" />
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <div>
                                                <button class="btn btn-primary btn-sm" onclick="verify()" data-dismiss="modal" aria-hidden="true">Login</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
