    <br><br><br><br>
    <div id="botwar">
    <div class="container">

        <div class="preload_splash" id="preload_splash">
            <div class="logo_splash">
                <span style="color: darkturquoise;">Content </span>Loading
            </div>
            <div class="loader-frame_splash">
                <div class="loader1_splash" id="loader1_splash"></div>
                <div class="loader2_splash" id="loader2_splash"></div>
            </div>
        </div>
        <br><br>
        <div class="row">

            <div class="col-md-12  d-flex align-items-center justify-content-center " style="padding:0px">

                <div id="box" style="background-color: #222;; padding:50px; border-top-left-radius:10px;border-top-right-radius:10px;">

                    <div class="row">
                        <div class="col-md-12 ">

                            <p style="font-family: italic">The objective of this mission is to spam my competitors' companies servers, and increase my profit while their systems are down. But it is not going to be as easy as it sounds. You can't mannually spam the servers. You
                                have to code a spammer to accomplish this task. Also, the companies have deployed honeypot servers to prevent the possible breakdown due to malicious attempts. One catch is, their honeypot servers have a maximum capacity,
                                just like how your spam mailer script has a capacity. <br><br> Once you have positioned yourself inside the honeycomb structured network, you would be assigned a random capacity between 1 and 20 at each turn. If you
                                place your script adjacent to your own scripts, it will add to their capacity by 1. If you place your script adjacent to any of the honeypots, it can then corrupt them, if your capacity is higher than the adjacent cell's
                                capacity.
                                <br><br> Spam as many systems as possible to beat the honeypot servers and clear the mission. </p>
                        </div>

                    </div>

                </div>

            </div>

            <div class="file-upload">
                <div class="button">
                    <a href="https://hack-a-venture.psglogin.in/botwars_files/UserBot.cpp" download="" style="border-bottom-left-radius:10px;">Download(C++)</a>
                    <a href="https://hack-a-venture.psglogin.in/botwars_files/user_defined_bot.java" download="">Download(Java)</a>
                    <a href="https://hack-a-venture.psglogin.in/botwars_files/player2.py" download="" style="width:34%;border-bottom-right-radius:10px;">Download(Python)</a>
                </div>
            </div>

        </div>

        <div class="row" style="margin-top:20px">
            <label style="border-radius:10px;" class="file-upload__label" id='showSample' onclick="window.open('./proximity.html')" data-backdrop="static">Sample</label><br>
        </div>
        <div class="row" style="margin-top:20px">

            <div class="form-group">
                <select style="border: 1px solid #222;width:155px;height: 50px;border-radius:0px;" class="form-control" id="sel1">
                    <option hidden>Language</option>  
                    <option>C++</option>
                      <option>Java</option>
                      <option>Python</option>
                    </select>

            </div>
            <div>
                <div class="file-upload">
                    <label for="upload" style="border-radius:10px;" class="file-upload__label">Upload</label>
                    <input id="upload" class="file-upload__input" type="file" name="file-upload" onchange="PreviewText();">
                </div>

            </div>

        </div>
        <div class="row" style="margin-top:20px">

            <div>
                <div class="file-upload">

                    <label style="border-radius:10px;" class="file-upload__label" data-toggle="modal" data-target="#myModal" id='showOutput' onclick='displayOutput()' data-backdrop="static">Output</label>
                </div>

            </div>

        </div>
    </div>


    <div id="myModal" class="modal fade" role="dialog" style="background-color: rgba(0, 0, 0, 0.9);">
        <div class="modal-dialog">

            <div class="modal-content" style="background:none !important;display:block;">
                <div id="gameBoard"></div>

                <div style="clear: both;"></div>
                <div id="red-stats">
                    <span id="text-red-soldiers" class="text-red">Number of <br>secured systems:<br></span> <span id="red-soldiers" class="text-bold">0</span>
                    <br />

                </div>

                <div class="container-red-dice-roll">
                    <div class="hex-row">
                        <div class="hex red" id="redDiceRoll"></div>
                    </div>
                </div>

                <div class="container-red-dice-roll">
                    <div class="hex-row">
                        <div class="hex blue" id="blueDiceRoll"></div>
                    </div>
                </div>

                <div id="blue-stats">
                    <span id="text-blue-soldiers" class="text-blue">No of <br>spammed systems:<br></span> <span id="blue-soldiers" class="text-bold">0</span>
                    <br />

                </div>

                <div class="no-display">

                    <div id="dialog-game-config" title="Game Setup">
                        <h3>Players</h3>
                        <h3>On Takeover</h3>
                        <div><span>Neighboring Territories</span> <span class="config-options" config="neighborTerritories">strengthen</span></div>
                        <div><span>Enemy Territories</span> <span class="config-options" config="enemyTerritories">no change</span></div>
                        <h3>Victory Condition</h3>
                        <div><span>Win due to:</span> <span class="config-options" config="victoryCondition">most soldiers</span></div>
                        <h3>Gameboard</h3>
                        <div><span>Landmass:</span> <span class="config-options" config="landMass">all</span></div>
                    </div>

                    <div id="dialog-game-end" style="z-index:99999999; display:block" title="Game Over!">
                        <h2>Winner:</h2>
                        <span id="game-winner"></span>
                    </div>

                    <div id="dialog-game-end1" style="z-index:9999999999; display:block" title="Game Over!">
                        <h2>Error:</h2>
                        <span id="game-error"></span>
                    </div>

                </div>
            </div>

            <div style="clear:both; float:right">
                <button type="button" class="btn btn-default" onclick="window.location.reload()" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>

</div>


<!-- <script type="text/javascript" src="resources/js/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="resources/js/jquery-ui.min.js"></script> -->

