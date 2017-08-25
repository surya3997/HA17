/**
 * This function is used to load the given content into the Help Bar.
 * 
 */
function LoadHelpBarContent(jsonData) {
    //Load the level information first followed by Objective
    var stageName = '<div id="stage-name">' + jsonData.stageName + '</div>';
    var stageObjective = '<div id="objective">' + jsonData.stageObjective + '</div>';
    //Load the hints into a div
    var hintsData = '<div id="hints">';
    for (var hintIndex = 0; hintIndex < jsonData.hints.length; hintIndex++) {
        hintsData += '<p>' + jsonData.hints[hintIndex] + '</p>';
    }
    hintsData += '</div>';
    //Put up a button for more hints
    var moreHintsButton = '<div id="get-more-hints"><button type="button" class="btn btn-info" id="more-hints-button"> Get Hints </button></div>';
    //Put all the data together
    var helpPaneContent = stageName + stageObjective + '<hr />' + hintsData + moreHintsButton;
    $('#ha-help-pane-content').html(helpPaneContent);
}

/**
 * Return the level from the GET parameters in the page URL.
 * If not found returns ILLEGAL status
 */
function GetCurrentLevelId() {
    var returnMsg = new Array();
    returnMsg['status'] = EnumStatus.ILLEGAL;
    if (window.location.pathname.indexOf('index.php') == -1) {
        var levelStart = window.location.search.indexOf('level=') + 6;
        if (levelStart == -1) {
            alert('Invalid location. Rerouting packets. Please hold.');
            window.location = 'index.php';
        }
        var levelEnd = window.location.search.indexOf('&', levelStart);
        if (levelEnd == -1) { //This is the last parameter. Keep the end as the end of the string
            levelEnd = window.location.search.length;
        }
        returnMsg['level'] = window.location.search.substr(levelStart, (levelEnd - levelStart));
        returnMsg['status'] = EnumStatus.OK;
    }
    return returnMsg;
}


function PositionElement(id, width, height) {
    var xOffset = $(window).width() - width;
    var yOffset = $(window).height() - height;

    $(id).css('top', yOffset / 2);
    $(id).css('left', xOffset / 2);
}

/**
 * Function to redirect the user after a session expiration.
 */
function SessionExpiredPageRedirect() {
    $('#session-expired-page-redirect').dialog("open");
}

/**
 * Function to redirect the user if the status is failed.
 */
function HandleAuthFailedStatus(status) {
    if (status == EnumStatus.AUTH_FAILED) {
        SessionExpiredPageRedirect();
    }
}

/**
 * Function to unlock and load the next hint.
 */
function GetNextHint(level) {
    /* $.post('ajax/buymorehint.php', { level: level }, function(response) {
        var jsonData = JSON.parse(response);
        HandleAuthFailedStatus(jsonData.status);
        if (jsonData.status == EnumStatus.OK) {
            //Load the new hint into the hint bar.
            var hints = $('#ha-help-pane #hints').html();
            hints += '<p>' + jsonData.newHint + '</p>';
            $('#ha-help-pane #hints').html(hints);
        } else if (jsonData.status == EnumStatus.FAILED) {
            //TODO This is a general failure. Show the error message in a decent box.
            InvokeCustomMessageDialog('Something went wrong. <br />Message : ' + jsonData.message);
        } else if (jsonData.status == EnumStatus.ILLEGAL) {
            //Has to be an illegal level
            InvokeCustomMessageDialog("You do not have permission to play the level for which you have requested a hint. Try again later.");
        } else if (jsonData.status == EnumStatus.HINT_OVER) {
            //No more hints for this level. Good luck bro.
            InvokeCustomMessageDialog("I have done all I can for you. The fate of humanity now lies in your hands. (No more hints for this level)");
        } else if (jsonData.status == EnumStatus.HINT_COOLDOWN) {
            //Need to wait some more time before the hints are revealed.
            InvokeCustomMessageDialog("You need to wait for sometime before I can tell you something. (Please wait " + jsonData.time_left + " for your next hint)");
        }
    }); */
}

/**
 * Function to invoke a Dialog based on a given message.
 */
function InvokeCustomMessageDialog(message, customHandler) {
    $('#general-info-dialog-content').html(message);
    if (customHandler != undefined) { //Have to reset the dialog properties
        $('#general-info-dialog').dialog({
            close: customHandler
        });
    }
    $('#general-info-dialog').dialog("open");
}

/**
 * Function to check if the browser is that of a mobile phone.
 * This should stop the user from playing anything.
 * TODO Bring a super big div and cover everything up :D
 */
function IsMobileBrowser() {
    var check = false;
    (function(a) { if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4))) check = true; })(navigator.userAgent || navigator.vendor || window.opera);
    return check;
};

if (IsMobileBrowser()) {
    window.location = 'mobilenotallowed.php';
}

/**
 * Function for tracking the user activity on one of the level screens.
 */
window.activityTracker = (new Date()).getTime();
window.activityTrackerInterval = setInterval(function() {
    var levelIDData = GetCurrentLevelId();
    if (levelIDData['status'] != EnumStatus.OK) {
        //Cancel the activity if the user is not in a level page
        clearInterval(window.activityTrackerInterval);
        return;
    }
    var cTime = (new Date()).getTime();
    if ((cTime - window.activityTracker) <= 5000) {
        /*   $.post('ajax/levelTime.php', { level: levelIDData['level'] }, function(data) {
              var jsonData = JSON.parse(data);
              HandleAuthFailedStatus(jsonData.status);
          }); */
    }
}, 5000);

//Keep changing the activityTracker on every mouse move.
document.onmousemove = function() {
    window.activityTracker = new Date().getTime();
}

/**
 * Stuff to be executed once everything is loaded fully.
 */
$(document).ready(function() {

    $('#endOfGameTimer').countdown("2017/09/23", function(event) {
        var totalHours = event.offset.totalDays * 24 + event.offset.hours;
        $(this).html('Game ends in : ' + event.strftime(totalHours + ' Hrs %M Mins %S Secs'));
    });
    /**
     * This is for the logout button in the Navigation bar
     */
    $("#LogoutUser").on('click', function() {
        /*     $.post('ajax/logout.php', {}, function(response) {
                window.location = "index.php";
            }); */
    });

    $('#ShowContact').on('click', function() {
        InvokeCustomMessageDialog('<div style="text-align:center;font-size:1.5em;font-weight:bold;">Contact</div><br><div><span style="font-weight:bold;">Email : </span>hackaventure2k17@gmail.com</div><div><span style="font-weight:bold;"> Co-ordinator : </span>Surya Prasath S</div><div><span style="font-weight:bold"> Phone Number : </span>+91 97917 45977</div>');
    });

    /* $.post('ajax/getLastSeenAnnoun.php', {}, function(response) {
        var jsonData = JSON.parse(response);
        if (jsonData.status == EnumStatus.OK) {
            if (jsonData.count == 0) {
                $('#announ_bell').removeClass('has_count_announ');
            } else {
                $('.has_count_announ').attr('data-after', jsonData.count);
            }
        }
    }); */

    $('#announ_bell').on('click', function() {
        var self = this;
        /* $.post('ajax/getLastSeenAnnoun.php', { 'PUT': '' }, function(response) {
            $(self).removeClass('has_count_announ');
        }); */
    });

    /**
     * Kicks the user out after a Session Expiration
     */
    $('#session-expired-page-redirect').dialog({
        autoOpen: false,
        width: 400,
        height: 150,
        modal: true,
        close: function() {
            document.location = 'index.php';
        },
        buttons: [{
            text: "Ok",
            click: function() {
                $(this).dialog("close");
            }
        }]
    });

    /**
     * Shows a Dialog with custom message with a single button and an optional close handler.
     */
    $('#general-info-dialog').dialog({
        autoOpen: false,
        width: 450,
        height: 250,
        modal: true,
        buttons: [{
            text: "Ok",
            click: function() {
                $(this).dialog("close");
            }
        }]
    });

    /**
     * HelpBar Content Format (HTML)
     * <ha-help-pane-content>
     *  <stage-name> </stage-name>
     *  <objective> </objective>
     *  <hints> 
     *  </hints>
     *  <get-more-hints>
     *  </get-more-hints>
     * </ha-help-pane-content>
     */

    /**
     * Loads the Help Pane using the MbExtruder
     */
    $(function() {
        var tWidth = $(window).height();
        $("#ha-help-pane").buildMbExtruder({
            position: "right",
            width: 250,
            flapDim: "100%",
            textOrientation: "tb",
            extruderOpacity: 1,
            closeOnExternalClick: true,
            top: 120,
            onClose: function() {},
            onContentLoad: function() {}
        });

        $("#ha-game-pane").buildMbExtruder({
            position: "right",
            width: 350,
            flapDim: "100%",
            textOrientation: "tb",
            extruderOpacity: 1,
            closeOnExternalClick: true,
            top: (tWidth - 100),
            onClose: function() {},
            onContentLoad: function() {}
        });

        $.fn.changeLabel = function(text) {
            $(this).find(".flapLabel").html(text);
            $(this).find(".flapLabel").mbFlipText();
        };

        if (window.location.pathname.indexOf('index.php') != -1) { // Load the general information.
            $('#ha-help-pane-content').html('Welcome to HackArena Console.<hr />This is where you can select different locations you would like to play next.<br />');
        } else { ///Load the help for the particular stage
            //Get the level id parameter from the url.
            var levelIdDetails = GetCurrentLevelId();
            if (levelIdDetails['status'] != EnumStatus.OK) {
                //TODO this is too harsh. Clean this up a bit and make it look better.
                window.location = 'index.php';
            }
            var level = levelIdDetails['level'];
            /* $.post('ajax/levelhint.php', { level: level }, function(response) {
                var jsonData = JSON.parse(response);
                HandleAuthFailedStatus(jsonData.status);
                if (jsonData.status == EnumStatus.OK) {
                    LoadHelpBarContent(jsonData);
                } else {
                    //Illegal Level.
                    InvokeCustomMessageDialog("This level is not open yet. Complete the prerequisite levels first.", function() {
                        window.location = 'index.php';
                    });
                }
            }); */
        }
    });

    /**
     * This is for the hints pane - get more hints confirm dialog
     */
    $('#help-pane-confirm-hint').dialog({
        autoOpen: false,
        modal: true,
        width: 500,
        height: 200,
        resizable: false,
        buttons: [{
                text: "Confirm",
                click: function() { //Sends out the get new hint dialog box.
                    $(this).dialog("close");
                    //Perform the required logic here.
                    var levelIDResults = GetCurrentLevelId();
                    //We need to make a confirmation dialog box here.
                    if (levelIDResults['status'] == EnumStatus.OK) {
                        var level = levelIDResults['level'];
                        GetNextHint(level);
                    } else {
                        //This means that the level id is not there. Kick this guy out.
                        InvokeCustomMessageDialog('Our navigation system seems to have drifted of course. Rerouting you to the last proper location.', function() {
                            document.location = 'index.php';
                        });
                    }
                    //We need to open the extruder since it gets closed on external click
                    $('#ha-help-pane').openMbExtruder(true);
                }
            },
            {
                text: "Cancel",
                click: function() {
                    $(this).dialog("close");
                }
            }
        ]
    });
    /**
     * This is for the help pane's get more hints option.
     */
    $('#ha-help-pane').on('click', '#more-hints-button', function() {
        //TODO Get an alert out first before proceeding with the hint purchase.
        $('#help-pane-confirm-hint').dialog("open");
    });

    /**
     * For creating the inventory on item click
     */
    /* $("#ha-inventory-dialog").dialog({
        autoOpen: false,
        width: 665,
        height: 500,
        buttons: [{
            text: "Close",
            click: function() {
                $(this).dialog("close");
            }
        }]
    }); */

    /**
     * Listener to open the inventory dialog box.
     */
    /* $("#view-inventory").click(function(event) {
        $("#ha-inventory-dialog").dialog("open");
        //Start the AJAX call to fetch the data
        $.post('ajax/getInventoryItems.php', {}, function(data) {
            //Load the tooltips for the items in the inventory. Courtesy of JQueryUI
            var jsonData = JSON.parse(data);
            HandleAuthFailedStatus(jsonData.status);
            if (jsonData.count <= 0) {
                //Oops. This should not happen really.
                $('#inventory-list-pane').html('<div>No items in your inventory.</div>');
            } else {
                //Load em up
                var htmlData = '';
                for (var itemIter = 0; itemIter < jsonData.count; itemIter++) {
                    htmlData += '<div class="inventory-item">';
                    htmlData += '<div class="inventory-item-name">' + jsonData.items[itemIter].name + '</div>';
                    htmlData += '<div class="inventory-item-image"> <img src="res/inventory_items/' + jsonData.items[itemIter].image + '_50.png" width="50px" height="50px"/>' + '</div>';
                    htmlData += '<div class="inventory-item-desc"> ' + jsonData.items[itemIter].description + '</div>';
                    htmlData += '</div>';
                }
                //Set the data
                $('#inventory-list-pane').html(htmlData);
                //Load the tooltip for everything.
                $('[data-toggle="tooltip"]').tooltip({
                    show: {
                        effect: "slideDown",
                        delay: 50
                    }
                });
            }
        });
        event.preventDefault();
    }); */

    /**
     * Listener for opening the clicked on item in the detailed viewer.
     */
    /* $('#ha-inventory-dialog').on('click', '.inventory-item', function() {
        var selectedItem = $(this).children();
        var selectedItemName = $(selectedItem[0]).html();
        $('#inventory-selected-item-name').html(selectedItemName);
        var selectedItemImage = $($(selectedItem[1]).html()).attr('src');
        $('#inventory-selected-item-image').html('<img src="' + selectedItemImage + '" height="150px" width="150px"/>');
        var selectedItemDesc = $(selectedItem[2]).html();
        $('#inventory-selected-item-description').html(selectedItemDesc);
    }); */

    /*
     * This is for the ToolTip using Jquery UI 
     */
    $('[data-toggle="tooltip"]').tooltip({
        show: {
            effect: "slideDown",
            delay: 50
        }
    });

    /**
     * This is for loading the announcements
     */
    /*
    $.post('ajax/getAnnouncements.php', {}, function(data) {
        var jsonData = JSON.parse(data);
        HandleAuthFailedStatus(jsonData.status);
        if (jsonData.status == EnumStatus.OK) {
            //Load it in.
            var elemCount = jsonData.content.length;
            var htmlData = '';
            for (var elemIter = 0; elemIter < elemCount; elemIter++) {
                htmlData += '<li class="message-preview"><a href="#"><div class="media"><div class="media-body">';
                htmlData += '<h5 class="media-heading"><strong>Administrator says</strong></h5>';
                htmlData += '<p>' + jsonData.content[elemIter].data + '</p>';
                htmlData += '</div></div></a></li>';
            }
            $('#announcements').html(htmlData);
        }
    });
    
    */



    $('#go-fullscreen').click(function() {
        // alert("now going to full screen");
        DoFullScreen();
    });

    $('#watch-animation').click(function() {
        window.location = 'animation.php?level=1';
    });
    var enable_full_screen = true;

    function DoFullScreen() {
        if (enable_full_screen) {
            var docElm = document.documentElement;
            var docElm = document.documentElement;
            if (docElm.requestFullscreen) {
                docElm.requestFullscreen();
            } else if (docElm.mozRequestFullScreen) {
                docElm.mozRequestFullScreen();
            } else if (docElm.webkitRequestFullScreen) {
                docElm.webkitRequestFullScreen();
            } else if (docElm.msRequestFullscreen) {
                docElm.msRequestFullscreen();
            }
            enable_full_screen = false;
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.webkitCancelFullScreen) {
                document.webkitCancelFullScreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            }
            enable_full_screen = true;
        }
    }
});