    <div class="container" style="height:350px">
    	<br><br><br><br><br><br><br>
    	<center><p><?php $this->printVar('level_question'); ?></p></center>
        <div class="login-wrap">
            <div class="transbox" >
                    <center><div style="margin-top:1%;  display:none">zebras zebras zebras</div></center>
                <div class="login-html">
                    <div class="login-form" style=" overflow:hidden;">
                        <center>
                            <form class="form-horizontal" id="formLogin">
                                <center>
                                    <img id="user_icon" src="./res/images/levels/level7/user.png"></img>
                                </center>
                                <br>
                                 <h1>Admin</h1>
                                 <input type="password" class="form-control form-rounded transparent-input" id="passwd" placeholder="Password"><br> 
                           </form>
                            <div class="game_btn">
                                 <button id="login_btn" onclick='fn_check()' class="btn btn-lg btn-primary btn-block">Login</button>
                            </div>
                        </center>   
                    </div>  
                </div>   
            </div>    
        </div> 
    </div>  