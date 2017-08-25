var player = "x";
var comp = "o";
var flag = 1;
var flg = 1;
var you = 0;
var CPU = 0;
var tie = 0;
var diff = 1;
var tmovs = 0;
var Game = false;
var first = false;
var s3 = [1, 3, 5, 7];
var s1 = [0, 2, 4, 6, 8];
var grid = [0, 0, 0, 0, 0, 0, 0, 0, 0];
var win = [
    [0, 1, 2],
    [3, 4, 5],
    [6, 7, 8],
    [0, 3, 6],
    [1, 4, 7],
    [2, 5, 8],
    [0, 4, 8],
    [2, 4, 6]
];

$(".box").html("");
$(".box").addClass("col-xs-4");
document.getElementById("Select").value = "Random";
$(".game").hide();


function newGame() {
    grid = [0, 0, 0, 0, 0, 0, 0, 0, 0];
    $(".box").html("");
    $(".box").css("background", "white");
    $(".box").css("color", "black");
    tmovs = 0;
    flag = 1;
    flg = 1;
    if (first)
        playComp();
}

function tieGame() {
    Game = false;
    tie++;
    $("#comm").text("Game Tied!");
    setTimeout(endGame, 1500);
}

function endGame() {
    $("#you").text(you);
    $("#CPU").text(CPU);
    $("#tie").text(tie);
    $(".game").fadeOut(100);
    $(".dialog").delay(100).fadeIn();
}

function getEasy() {
    var x = Math.floor(Math.random() * 9);
    while (grid[x])
        x = (x + 1) % 9;
    return x;
}

function getMedium() {
    var a, b, c;
    for (i = 0; i < win.length; i++) {
        a = grid[win[i][0]];
        b = grid[win[i][1]];
        c = grid[win[i][2]];
        if ((a == b) && (a == 2) && !c)
            return win[i][2];
        if ((b == c) && (b == 2) && !a)
            return win[i][0];
        if ((c == a) && (c == 2) && !b)
            return win[i][1];
    }
    for (i = 0; i < win.length; i++) {
        a = grid[win[i][0]];
        b = grid[win[i][1]];
        c = grid[win[i][2]];
        if ((a == b) && a && !c)
            return win[i][2];
        if ((b == c) && b && !a)
            return win[i][0];
        if ((c == a) && c && !b)
            return win[i][1];
    }
    return -1;
}

function fromS3() {
    var x = Math.floor(Math.random() * 4);
    for (i = 0; grid[s3[x]] && i < 15; i++)
        x = (x + 1) % 4;
    if (i <= 4)
        return s3[x];
}

function fromS1() {
    var x = Math.floor(Math.random() * 5);
    for (i = 0; grid[s1[x]] && i < 15; i++)
        x = (x + 1) % 5;
    if (i < 5)
        return s1[x];
    return fromS3();
}

function inS3() {
    for (i = 0; i < 4; i++)
        if (grid[s3[i]] == 1)
            return 1;
    return 0;
}

function getHard() {
    var x = getMedium();
    if (x != -1)
        return x;
    else if (first && flag) {
        flag = 0;
        return fromS1();
    } else if (!grid[4])
        return 4;
    else if (grid[4] == 1 || inS3())
        return fromS1();
    else
        return fromS3();
    return -1;
}

function playComp() {
    if (!Game)
        return;
    else if (tmovs == 9) {
        tieGame();
        return;
    }
    switch (diff) {
        case 1:
            var x = getEasy();
            break;
        case 2:
            var x = getMedium();
            break;
        case 3:
            x = getHard();
    }
    if (x == -1)
        x = getEasy();
    $("#" + x).text(comp);
    changeColor(x);
    grid[x] = 2;
    tmovs++;
    if (tmovs == 9)
        tieGame();
}

function changeColor(x) {
    x = "#" + x;
    ($(x).text() == "x") ? $(x).css("color", "red"): $(x).css("color", "#00b8e6");
}

function changeBgcolor(x) {
    x = "#" + x;
    ($(x).text() == "x") ? $(x).css("background", "red"): $(x).css("background", "#00b8e6");
    $(x).css("color", "white");
}

function checkWin() {
    var a, b, c;
    for (i = 0; i < win.length; i++) {
        a = grid[win[i][0]];
        b = grid[win[i][1]];
        c = grid[win[i][2]];
        if ((a == b) && (a == c) && a) {
            Game = false;
            if (a == 1) {
                $("#comm").text("You Win!");
                if (flg) {
                    you++;
                    flg = 0;
                }
            } else {
                $("#comm").text("CPU Wins!");
                CPU++;
            }
            changeBgcolor(win[i][0]);
            changeBgcolor(win[i][1]);
            changeBgcolor(win[i][2]);
            setTimeout(endGame, 1500);
            break;
        }
    }
}

function click_0() {
    if ($("#0").text().length === 0 && Game) {
        $("#0").text(player);
        changeColor(0);
        grid[0] = 1;
        tmovs++;
        checkWin();
        playComp();
        checkWin();
    }
}

function click_1() {
    if ($("#1").text().length === 0 && Game) {
        $("#1").text(player);
        changeColor(1);
        grid[1] = 1;
        tmovs++;
        checkWin();
        playComp();
        checkWin();
    }
}

function click_2() {
    if ($("#2").text().length === 0 && Game) {
        $("#2").text(player);
        changeColor(2);
        grid[2] = 1;
        tmovs++;
        checkWin();
        playComp();
        checkWin();
    }
}

function click_3() {
    if ($("#3").text().length === 0 && Game) {
        $("#3").text(player);
        changeColor(3);
        grid[3] = 1;
        tmovs++;
        checkWin();
        playComp();
        checkWin();
    }
}

function click_4() {
    if ($("#4").text().length === 0 && Game) {
        $("#4").text(player);
        changeColor(4);
        grid[4] = 1;
        tmovs++;
        checkWin();
        playComp();
        checkWin();
    }
}

function click_5() {
    if ($("#5").text().length === 0 && Game) {
        $("#5").text(player);
        changeColor(5);
        grid[5] = 1;
        tmovs++;
        checkWin();
        playComp();
        checkWin();
    }
}

function click_6() {
    if ($("#6").text().length === 0 && Game) {
        $("#6").text(player);
        changeColor(6);
        grid[6] = 1;
        tmovs++;
        checkWin();
        playComp();
        checkWin();
    }
}

function click_7() {
    if ($("#7").text().length === 0 && Game) {
        $("#7").text(player);
        changeColor(7);
        grid[7] = 1;
        tmovs++;
        checkWin();
        playComp();
        checkWin();
    }
}

function click_8() {
    if ($("#8").text().length === 0 && Game) {
        $("#8").text(player);
        changeColor(8);
        grid[8] = 1;
        tmovs++;
        checkWin();
        playComp();
        checkWin();
    }
}

function run_tic_tac() {
    Game = true;
    var x = document.getElementById("Select").value;
    $(".dialog").fadeOut(100);
    $(".game").delay(100).fadeIn();
    if ($("#Easy").prop("checked"))
        diff = 1;
    if ($("#Medium").prop("checked"))
        diff = 2;
    if ($("#Hard").prop("checked"))
        diff = 3;
    if (x == "You")
        first = false;
    if (x == "CPU")
        first = true;
    if (x == "Alternate")
        (first) ? first = false : first = true;
    if (x == "Random")
        (Math.floor(Math.random() * 2)) ? first = true : first = false;
    if ($("#X").prop("checked")) {
        player = "x";
        comp = "o";
    } else {
        player = "o";
        comp = "x";
    }
    newGame();
    console.log("came");
}