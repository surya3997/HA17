            <div tag="mobile_ui">
                <div class='wrap'>
                    <div class='content'>
                        <div id="notifier">
                            <div id="timer"></div>
                        </div>
                        <div id="phone_div">
                            <div class="container">
                                <img id="img1" src="./res/images/map.png" onclick="getMap();"></img>
                                <img id="img2" src="./res/images/linkedin.png" onclick="lbrd()"></img>
                                <img id="img3" src="./res/images/Quora.png"></img>
                                <img id="img4" src="./res/images/whatsapp.png" onclick="chat()"></img>
                            </div>
                        </div>

                        <div id="chartdiv"></div>

                        <div id='leaderboard'>
                            <h1><span>Leader Board</span></h1>
                            <div class="leaderboard_content"></div>
                        </div>

                        <div id="chat" style="display:none">
                            <div class="chat_box">
                                <div class="chat_head">
                                    <center>Online</center>
                                </div>
                                <div class="chat_body">
                                    <div class="user">Group Chat</div>
                                    <div class="user1">Private Chat</div>
                                </div>
                            </div>
                        </div>

                        <div class="msg_box" style="display:none">
                            <div class="msg_head">Messages
                                <div class="close" id="cl1">x</div>
                            </div>
                            <div class="msg_wrap" style="height:425px">
                                <div class="msg_body">
                                    <div class="msg_a">
                                    <?php 
                                            $sql = 'SELECT name FROM `ha_level` WHERE `id` = '.$this->getPage();
                                            global $db;
                                            $query = $db->query($sql);

                                            $row = $db->result($query);
                                            
                                            echo $row->name;
                                        ?>
                                    </div>
                                    <div class="msg_b"> this is from a</div>
                                    <div class="msg_insert"></div>
                                </div>
                                <div class="msg_footer" style="height:75px">
                                    <textarea class="msg_input" rows="2" id='t'></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="msg_box1" style="display:none">
                            <div class="msg_head1">Messages
                                <div class="close" id="cl2">x</div>
                            </div>
                            <div class="msg_wrap1" style="height:425px">
                                <div class="msg_body1">
                                    <div class="msg_a1">this is from a</div>
                                    <div class="msg_b1"> this is from b</div>
                                    <div class="msg_insert1"></div>
                                </div>
                                <div class="msg_footer" style="height:75px">
                                    <textarea class="msg_input" rows="2" id='s'></textarea>
                                </div>
                            </div>
                        </div>

                        <div id="bottom_nav_bar">
                            <button class="btn button_justify" href="#" onclick="getBack()"><span class="fa fa-play"></span></button>
                            <button class="btn button_justify" href="#" onclick="getHome()"><span class="fa fa-circle"></span></button>
                            <button class="btn button_justify" href="#"><span class="fa fa-square"></span></button>
                        </div>
                    </div>
                </div>
            </div>
            <i id="pop_mobile" class="button fa fa-phone" href='#'></i>
        </div>
    </div>
    <!-- #content-wrapper -->
    </div>
    <!-- #wrapper -->

    <!-- jQuery -->
    <script src="js/general/jquery.js"></script>
    <script>
        /**
         * Place the loader div dead center
         */
        var leftOffset = ($(window).width() - 200) / 2;
        var topOffset = ($(window).height() - 200) / 2;
        $('#loader').css({
            'top': topOffset + 'px',
            'left': leftOffset + 'px'
        });
        $('#loader-overlay-image').css({
            'top': topOffset + 'px',
            'left': leftOffset + 'px'
        });
        if (document.getElementById('login').classList.contains('loaded')) {
            $('body').removeClass('loaded');
        }
        $(window).on('load', function() {
            $('body').addClass('loaded');
            setTimeout(function() {
                $('#loader-wrapper').css('display', 'none');
            }, 100);
        });
    </script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/general/bootstrap.min.js"></script>
    <!-- JQuery UI -->
    <script src="js/general/jquery-ui.min.js"></script>
    <script src="js/general/jquery.countdown.min.js"></script>
    <!-- For the custom Enumerations -->
    <script src="js/enums.js"></script>
    <!-- mbExtruder for the help Slider -->
    <script src="js/general/jquery.mb.flipText.js"></script>
    <script src="js/general/mbExtruder.js"></script>

    <!-- Custom JavaScript -->
    <script src="js/ha_general.js"></script>
    <script src="js/ha_tic_tac.js"></script>
    <script src="./js/leaderboard.js"></script>
    <script src="js/map.js"></script>
    <script src="js/printTime.js"></script>
    <script src="js/ha_basetemplate.js"></script>
    <script src="./js/chat.js"></script>
    <script src="js/ammap.js"></script>
    <script src="js/worldLow.js"></script>

    <!-- Level Specific JS file. Add dynamically. -->
    <?php $this->printVar('LEVEL_JS'); ?>
    <!-- <script src="js/L5.js"></script> -->
</body>

</html>
