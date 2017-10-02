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
                                <img id="img3" src="./res/images/Quora.png" onclick="wallet()"></img>
                                <img id="img4" src="./res/images/whatsapp.png" onclick="chat()"></img>
                            </div>
                        </div>

                        <div id="chartdiv"></div>

                        <div id='leaderboard'>
                            <h1><span>Levels completed by users</span></h1>
                            <div class="leaderboard_content"></div>
                        </div>

                        <div id="wallet" style="display:none">
                        <h1><span>REMAINING BALANCE IN YOUR CRYPTO-CURRENCY ACCOUNT</span></h1>
                            <img id="bit_coin_img" src="./res/images/bcoin.ico"></img>
                            <div class="wallet_content"><h1>
                            <?php 
                                global $user;
                                global $db;
                                $sql = 'SELECT `score` FROM `ha_user` WHERE `id` = '.$user->getUserId();
                                $query = $db->query($sql);
                                $row = $db->result($query);
                                if ($row->score != NULL)
                                    echo $row->score;
                                else
                                    echo '0';
                            ?></h1></div>
                        </div>

                        <div id="chat" style="display:none">
                            <div class="chat_box">
                                <div class="chat_head">
                                    <center>Online</center>
                                </div>
                                <div class="chat_body">
                                    <div class="user1">Millionaire</div>
                                    <div class="user">Help Desk Chat</div>
                                </div>
                            </div>
                        </div>

                        <div class="msg_box" style="display:none">
                            <div class="msg_head">Help Desk Chat
                                <div class="close" id="cl1">x</div>
                            </div>
                            <div class="msg_wrap" style="height:425px">
                                <div class="msg_body">
                                    <div class="msg_a">
                                        This is a feature for you to ask any query related to the event.<br>
                                        Use this feature effectively to ask valid queries or to report any bugs about the event<br>
                                        DO NOT ask level hints here!<br>
                                        DO NOT try to spam the inbox!<br>
                                        Severe actions will be taken for spamming...<br>
                                    </div>
                                    <div class="msg_a">
                                        After filtering valid queries the response with the query message will be posted here, <br>
                                        which could be publicly seen by all the users of Hack-a-Venture 2k17.<br>
                                    </div>
                                    <div class="msg_insert"></div>
                                </div>
                                <div class="msg_footer" style="height:75px">
                                    <textarea class="msg_input" rows="2" id='t'></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="msg_box1" style="display:none">
                            <div class="msg_head1">Millionaire
                                <div class="close" id="cl2">x</div>
                            </div>
                            <div class="msg_wrap1" style="height:425px">
                                <div class="msg_body1">
                                    <div class="msg_a1">I'll tell the tasks that you should complete through this chat.<br>Listen to my words clearly to avoid confusion about the mission...<br></div>
                                    <div class="msg_b1">Yep... sure</div>
                                    <div class="msg_a1">
                                    <?php 
                                            $sql = 'SELECT objective FROM `ha_level` where id = '.$this->getPage();
                                            global $db;
                                            $query = $db->query($sql);
                                            $row = $db->result($query);
                                            echo $row->objective;
                                        ?>
                                    </div>
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
                            <button class="btn button_justify" href="#" onclick="getHome()"><span class="fa fa-square"></span></button>
                        </div>
                    </div>
                </div>
            </div>
            <i id="pop_mobile" class="button fa fa-phone" href='#'></i>
        </div>
    </div>
    </div>
    </div>

 
    <script src="js/general/jquery.js"></script>
    <script>
        
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

    
    <script src="js/general/popper.min.js"></script>
    <script src="js/general/bootstrap.min.js"></script>
    
    <script src="js/general/jquery-ui.min.js"></script>
    <script src="js/general/jquery.countdown.min.js"></script>
    
    <script src="js/enums.js"></script>
    
    <script src="js/general/jquery.mb.flipText.js"></script>
    <script src="js/general/mbExtruder.js"></script>
    
    <script src="js/ammap.js"></script>
    <script src="js/worldLow.js"></script>
    <script src="js/ha_tic_tac.js"></script>
    <script src="js/ha_general.js"></script>
    <script src="./js/leaderboard.js"></script>
    <script src="js/map.js"></script>
    <script src="js/printTime.js"></script>
    <script src="js/ha_basetemplate.js"></script>
    <script src="./js/chat.js"></script>
    
    <?php $this->printVar('LEVEL_JS'); ?>
</body>

</html>
