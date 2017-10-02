    <div class="page" id='whatsapp'>
        <div class="marvel-device nexus5">
            <div style="-moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;-o-user-select:none;" unselectable="on" onselectstart="return false;" onmousedown="return false;">
                <a href="#" id="n" style="color:#444">whatsapp</a>
            </div>
            <div class="top-bar"></div>
            <div class="sleep"></div>
            <div class="volume"></div>
            <div class="camera"></div>
            <div class="screen">
                <div class="screen-container">
                    <div class="status-bar">
                    </div>
                    <div class="chat">
                        <div class="chat-container">
                            <div class="user-bar">
                                <div class="back">
                                    <i class="zmdi zmdi-arrow-left"></i>
                                </div>
                                <div class="avatar">
                                    <img src="./res/images/levels/level4/hack.jpg" alt="Avatar">
                                </div>
                                <div class="name">
                                    <span>Hacker</span>
                                    <span class="status" id="status">online</span>
                                </div>
                            </div>
                            <div id="myModal" class="modal">
                                <div class="modal-content">
                                    <span class="close">&times;</span>
                                    <form id="form_id" method="post" name="myform">
                                        <label>User Name :</label>
                                        <input type="text" name="username" id="wausername" />
                                        <label>Password :</label>
                                        <input type="password" name="password" id="wapassword" />
                                        <input type="button" value="Login" id="submit" onclick="validate()" />
                                    </form>
                                </div>
                            </div>
                            <div class="conversation">
                                <div class="conversation-container">
                                    <div class="message sent" id="conv1" style="display:none">
                                        <p id="p1">Tell me what have you accomplished!</p>
                                        <span class="metadata">
                                          <span class="time"></span><span class="tick"></span>
                                        </span>
                                    </div>
                                    <div class="message received" id="conv2" style="display:none">
                                        <p id="p2">I have broke through the world's best security system.</p>
                                        <span class="metadata"><span class="time"></span></span>
                                    </div>
                                    <div class="message sent" id="conv3" style="display:none">
                                        <p id="p3">I can't believe you. Could you tell me the truth?</p>
                                        <span class="metadata">
                                          <span class="time"></span><span class="tick"></span>
                                        </span>
                                    </div>
                                    <div class="message received" id="conv4" style="display:none">
                                        <span id="p4">I always return true words to everyone! </span>
                                        <span class="metadata"><span class="time"></span></span>
                                    </div>
                                </div>
                                <form class="conversation-compose">
                                    <div class="emoji">
                                    </div>
                                    <input class="input-msg" disabled name="input" id="input" placeholder="Type a message" value="" autocomplete="off" autofocus>
                                    <div class="photo">
                                        <i class="zmdi zmdi-camera"></i>
                                    </div>
                                    <div class="send">
                                        <div class="circle"> >
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

