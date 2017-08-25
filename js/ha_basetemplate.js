function getMap() {
    document.getElementById("phone_div").style.display = "none";
    document.getElementById("chartdiv").style.display = "block";
}

function getHome() {
    if (back_flag) {
        closeChat(back_flag);
    }
    document.getElementById("phone_div").style.display = "block";
    document.getElementById("chartdiv").style.display = "none";
    document.getElementById("chat").style.display = "none";
    document.getElementById("leaderboard").style.display = "none";
}

function getBack() {
    console.log(back_flag);
    if (back_flag == 0) {
        getHome();
    } else if (back_flag == 1) {
        closeChat(1);
    } else {
        closeChat(2);
    }
}

function chat() {
    document.getElementById("phone_div").style.display = "none";
    document.getElementById("chat").style.display = "block";
}

function lbrd() {
    document.getElementById("phone_div").style.display = "none";
    document.getElementById("leaderboard").style.display = "block";
}