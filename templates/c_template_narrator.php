<html>

<head>
    <link rel="shortcut icon" href="./res/logo/ms-icon-150x150.png">
    <link href="css/animation/story_line.css" rel="stylesheet" />
    <link href="css/animation/slider.css" rel="stylesheet" />
    <link rel="stylesheet" href="res/font-awesome/css/font-awesome.min.css">
</head>

<body id="narrate_page">
    <?php include_once("analyticstracking.php") ?>
    <div id="ha_anim_slider_container">
        <div id="ha-anim-slider-leftnav"><i class="fa fa-angle-left"></i></div>
        <div id="ha-anim-slider-pages">
        </div>
        <div id="ha-anim-slider-rightnav"><i class="fa fa-angle-right"></i></div>
        <div class="clear-div"></div>
    </div>
    <div id="animationBody">
        <div id="ha-anim-hero-speech-container">
            <div id="ha-anim-hero-speech">
                <span id="ha-anim-speech-typed"></span>
            </div>
        </div>

        <div id="ha-anim-heroine-speech-container">
            <div id="ha-anim-heroine-speech">
                <span id="ha-anim-heroine-speech-typed"></span>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="js/general/TweenMax.js"></script>
    <script type="text/javascript" src="js/general/jquery.min.js"></script>
    <script type="text/javascript" src="js/general/typed.min.js"></script>
    <script type="text/javascript" src="js/animation/story_line_setup.js"></script>
    <script type="text/javascript" src="js/animation/story_line.js"></script>
</body>

</html>
