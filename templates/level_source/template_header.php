<!DOCTYPE html>

<?php
$cookie_name = "password_of_employeeX";
$cookie_value = "GetThrough";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
?>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="./res/logo/ms-icon-150x150.png">
    <title><?php echo $this->getPageTitle(); ?></title>
    
    <link href="css/general/bootstrap.min.css" rel="stylesheet">
    <link href="res/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/general/mbExtruder.css" media="all" rel="stylesheet">
    <link href="css/general/jquery-ui.min.css" rel="stylesheet">

    <link href="css/ha-general.css" rel="stylesheet">
    <link href="css/cs_tic_tac.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="./css/phonepopstyle.css">
    <link rel="stylesheet" href="./css/chat.css">
    <link rel="stylesheet" href="./css/leaderboard.css">

    <?php $this->printVar('LEVEL_CSS'); ?>
</head>

<body id="login" class="loaded">
    <?php include_once("analyticstracking.php") ?>
<div class="container">
    <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">Hack-a-Venture</a>
            </div>
            <ul class="nav navbar-right top-nav">
                <li>
                    <div id="endOfGameTimer"></div>
                </li>
                <li>
                    <a href="./narrator.php?level=1" id="watch-animation" data-toggle="tooltip" title="View Story"><i class="fa fa-eye"></i></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell has_count_announ" id="announ_bell"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu message-dropdown" id="announcements">
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Welcome <?php echo $this->getUserName(); ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#" id="ShowContact"><i class="fa fa-fw fa-envelope"></i>Contact</a>
                            <a href="#" id="LogoutUser"><i class="fa fa-fw fa-power-off"></i>Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="ha-help-pane" class="{title:'Ask for Help'}">
            <div class="content">
                <div id="ha-robot-avatar-image">
                    <img src="res/images/hackaventure_150x150.png" id="hackaventure_logo"/>
                </div>
                <div id="ha-help-pane-content">
                    <div class="loading-image">
                        <img src="" />
                    </div>
                </div>
            </div>
        </div>

        <div id="session-expired-page-redirect" title="Session Expired" style="opacity:0">
            Session has expired. Please login again.
        </div>
        <div id="general-info-dialog" title="Information">
            <div id="general-info-dialog-content">
                .
            </div>
        </div>
        <div id="help-pane-confirm-hint" title="Confirmation for hint acquisition">
            You have initiated a hint acquisition. This is an irreversible process. You will lose points for each hint you purchase. Do you confirm ?
        </div>
        <div id="ha-game-pane" class="{title:'LetsPlay'}">
            <div class="container-fluid panel panel-warning">
                <div class="panel-heading">
                    <h1>Tic Tac Toe</h1>
                </div>
                <div class="score"><label style="float:left">You: <span id=you>0</span></label> <label>Tie: <span id=tie>0</span></label> <label style="float:right">CPU: <span id=CPU>0</span></label></div>
                <div class="game">
                    <div class="row">
                        <div id="0" class="box tl" onclick="click_0()"></div>
                        <div id="1" class="box tm" onclick="click_1()"></div>
                        <div id="2" class="box tr" onclick="click_2()"></div>
                    </div>
                    <div class="row">
                        <div id="3" class="box ml" onclick="click_3()"></div>
                        <div id="4" class="box mm" onclick="click_4()"></div>
                        <div id="5" class="box mr" onclick="click_5()"></div>
                    </div>
                    <div class="row">
                        <div id="6" class="box bl" onclick="click_6()"></div>
                        <div id="7" class="box bm" onclick="click_7()"></div>
                        <div id="8" class="box br" onclick="click_8()"></div>
                    </div>
                </div>
                <div class="dialog">
                    <div id=comm>Welcome!</div>
                    <form style="text-align:justify">
                        <label for="letter">Difficulty:</label> <br><input type="radio" name="difficulty" id="Easy" value="Easy"><small>Easy</small>
                        <input type="radio" name="difficulty" id="Medium" value="Medium"><small>Medium</small>
                        <input type="radio" name="difficulty" id="Hard" value="Hard" checked><small>Hard</small><br>
                        <label for="letter">First:</label>
                        <select id="Select">
                            <option value="You">You</option>
                            <option value="CPU">CPU</option>
                            <option value="Alternate">Alternate</option>
                            <option value="Random">Random</option>
                        </select><br>
                        <label for="letter">Choose: </label>
                        <input type="radio" name="choose" id="X" value="X" checked> X
                        <input type="radio" name="choose" id="O" value="O"> O<br>
                    </form>
                    <button onclick="run_tic_tac()" class="btn btn-block" id="play_button">Play</button>
                </div>
                <div style="color:green"><small>Hack-a-Venture Tictactoe</small></div>
            </div>
            <div style="color:white; font-size:1.5em; padding-bottom: 10px;">
                Stressed out ? Play this fun game for a while.
            </div>
        </div>
        <div id="content-wrapper">
